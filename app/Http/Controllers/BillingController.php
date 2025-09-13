<?php

namespace App\Http\Controllers;

use App\Models\BillingInvoice;
use App\Models\User;
use App\Models\Department;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Factures visibles : le patient ne voit que les siennes ; admin/doctor voient tout
        $invoices = BillingInvoice::with(['patient','department'])
            ->when($user->isPatient(), fn($q) => $q->where('patient_id', $user->id))
            ->latest()
            ->paginate(15);

        // Sélecteurs
        $patients = User::where('role', 'patient')
            ->orderBy('name')
            ->get(['id','name']);

        $departments = Department::orderBy('name')->get(['id','name']);

        // Pour lier une facture à une ordonnance existante
        $myPrescriptions = Prescription::select('id','title')
            ->when($user->isPatient(), fn($q) => $q->where('patient_id', $user->id))
            ->when($user->isDoctor(), fn($q) => $q->where('doctor_id', $user->id))
            ->latest()
            ->take(100)
            ->get();

        return view('billing.index', compact('invoices','patients','departments','myPrescriptions'));
    }

    public function store(Request $r)
    {
        // Admin & docteur : peuvent créer pour n'importe quel patient
        // Patient : ne peut créer QUE pour lui-même (sécurité)
        $data = $r->validate([
            'patient_id'              => 'required|exists:users,id',
            'department_id'           => 'nullable|exists:departments,id',
            'label'                   => 'required|string',
            'amount'                  => 'required|numeric|min:0',
            // Si tu passes explicitement le type/service :
            'service_type'            => 'nullable|in:consultation,examen,ordonnance,autre',
            'service_id'              => 'nullable|integer',
            // Ou bien si tu lies via le select d’ordonnance :
            'service_prescription_id' => 'nullable|exists:prescriptions,id',
        ]);

        $auth = Auth::user();
        if ($auth->isPatient() && (int)$data['patient_id'] !== (int)$auth->id) {
            abort(403, 'Un patient ne peut créer une facture que pour lui-même.');
        }

        // Priorité au select "Ordonnance liée" si rempli
        if (!empty($data['service_prescription_id'])) {
            $data['service_type'] = 'ordonnance';
            $data['service_id']   = (int)$data['service_prescription_id'];
        }
        unset($data['service_prescription_id']);

        $data['status'] = 'draft';

        BillingInvoice::create($data);

        return back()->with('ok', 'Facture créée.');
    }

    public function updateStatus(Request $r, BillingInvoice $invoice)
    {
        // Admin ou docteur uniquement
        $user = auth()->user();
        abort_unless($user->isAdmin() || $user->isDoctor(), 403);

        $data = $r->validate([
            'status' => 'required|in:draft,paid,cancelled',
        ]);

        $invoice->update(['status' => $data['status']]);

        return back()->with('ok', 'Statut mis à jour.');
    }


}
