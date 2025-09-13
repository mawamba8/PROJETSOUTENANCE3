<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $prescriptions = Prescription::with(['patient:id,name','doctor:id,name'])
            ->when($user->isPatient(), fn($q)=>$q->where('patient_id',$user->id))
            ->when($user->isDoctor(), fn($q)=>$q->where('doctor_id',$user->id))
            ->latest()
            ->paginate(12);

        // Liste patients pour le formulaire (uniquement si docteur/admin)
        $patients = ($user->isDoctor() || $user->isAdmin())
            ? User::where('role','patient')->orderBy('name')->get(['id','name'])
            : collect();

        return view('prescriptions.index', compact('prescriptions','patients'));
    }

    public function create()
    {
        $user = Auth::user();
        abort_unless($user->isDoctor() || $user->isAdmin(), 403);

        $patients = User::where('role','patient')->orderBy('name')->get(['id','name']);

        return view('prescriptions.create', compact('patients'));
    }

    public function store(Request $r)
    {
        $user = Auth::user();
        abort_unless($user->isDoctor() || $user->isAdmin(), 403);

        $data = $r->validate([
            'patient_id'         => 'required|exists:users,id',
            'title'              => 'required|string|max:255',
            'notes'              => 'nullable|string',
            'items'              => 'required|array|min:1',
            'items.*.drug'       => 'required|string|max:255',
            'items.*.dosage'     => 'required|string|max:255',
            'items.*.quantity'   => 'nullable|string|max:50',
            'items.*.duration'   => 'nullable|string|max:100',
            'items.*.frequency'  => 'required|string|max:100',
        ]);

        $prescription = Prescription::create([
            'patient_id' => (int)$data['patient_id'],
            'doctor_id'  => $user->id,
            'title'      => $data['title'],
            'notes'      => $data['notes'] ?? null,
            'status'     => 'validated', // ou 'draft' si tu veux valider plus tard
        ]);

        foreach ($data['items'] as $it) {
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'drug'            => $it['drug'],
                'dosage'          => $it['dosage'],
                'frequency'       => $it['frequency'],
                'duration'        => $it['duration'] ?? null,
                'quantity'        => $it['quantity'] ?? null,
            ]);
        }

        return redirect()->route('prescriptions.show', $prescription->id)
                         ->with('ok','Ordonnance créée.');
    }

    public function show($id){
        $p = Prescription::with(['items','patient:id,name','doctor:id,name'])->findOrFail($id);
        // Accès : patient concerné, son médecin, ou admin
        $user = Auth::user();
        abort_unless(
            $user->isAdmin() ||
            ($user->isDoctor() && $p->doctor_id === $user->id) ||
            ($user->isPatient() && $p->patient_id === $user->id),
            403
        );

        return view('prescriptions.show', ['prescription'=>$p]);
    }

    public function pdf($id){
        $p = Prescription::with(['items','patient','doctor'])->findOrFail($id);
        $user = Auth::user();
        abort_unless(
            $user->isAdmin() ||
            ($user->isDoctor() && $p->doctor_id === $user->id) ||
            ($user->isPatient() && $p->patient_id === $user->id),
            403
        );

        $html = view('prescriptions.pdf', ['p'=>$p])->render();
        return Pdf::loadHTML($html)->download("ordonnance-{$p->id}.pdf");
    }
}
