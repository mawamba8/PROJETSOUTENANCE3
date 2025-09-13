<?php

namespace App\Http\Controllers;

use App\Models\TransferRequest;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $specialties = Specialty::orderBy('name')->get(['id','name']);
        $patients    = User::where('role','patient')->orderBy('name')->get(['id','name']);

        // Admin voit tout ; Médecin/Patient : leurs transferts
        $q = TransferRequest::with(['patient','toSpecialty','fromDoctor','assignedDoctor'])->latest();

        if (!$user->isAdmin()) {
            $q->where(function ($qq) use ($user) {
                $qq->where('patient_id', $user->id)
                   ->orWhere('from_doctor_id', $user->id)
                   ->orWhere('assigned_doctor_id', $user->id);
            });
        }

        $transfers = $q->paginate(15);

        return view('transfers.index', compact('transfers','specialties','patients'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'patient_id'      => 'required|exists:users,id',
            'to_specialty_id' => 'required|exists:specialties,id',
            'urgency'         => 'required|in:low,normal,high,critical',
            'reason'          => 'nullable|string',
        ]);

        $auth = Auth::user();

        TransferRequest::create([
            'patient_id'         => (int)$r->patient_id,
            'from_doctor_id'     => $auth->isDoctor() ? $auth->id : null,
            'to_specialty_id'    => (int)$r->to_specialty_id,
            'urgency'            => $r->urgency,
            'reason'             => $r->reason,
            'status'             => 'pending',
            'assigned_doctor_id' => null,
        ]);

        return back()->with('ok', 'Demande de transfert créée.');
    }
}
