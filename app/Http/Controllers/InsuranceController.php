<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\InsuranceClaim;
use App\Models\BillingInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class InsuranceController extends Controller
{
    public function index()
    {
        // Tout le monde voit ses propres claims ; l'admin voit tout
        $claims = Auth::user()->role === 'admin'
            ? InsuranceClaim::with(['patient','invoice','insurance'])->latest()->get()
            : InsuranceClaim::with(['patient','invoice','insurance'])->where('patient_id', Auth::id())->latest()->get();

        $insurers = Insurance::orderBy('name')->get();
        $invoices = BillingInvoice::where('patient_id', Auth::id())->latest()->get();

        return view('insurance.index', compact('claims','insurers','invoices'));
    }

    public function createClaim(Request $r)
    {
        $r->validate([
            'invoice_id'   => 'required|exists:billing_invoices,id',
            'insurance_id' => 'required|exists:insurances,id',
        ]);

        InsuranceClaim::create([
            'patient_id' => Auth::id(),
            'invoice_id' => $r->invoice_id,
            'insurance_id' => $r->insurance_id,
            'status' => 'pending',
            // SLA 24h (on met l’échéance à +24h)
            'response_due_at' => now()->addDay(),
        ]);

        return back()->with('ok', 'Demande envoyée à l’assurance.');
    }

    /**
     * Méthode utilitaire pour TESTER le SLA :
     * - Marque "timeout" toutes les demandes en retard (response_due_at < now) et encore "pending".
     * Appelle-la en GET manuellement pour tester.
     */
    public function markTimeouts()
    {
        // Marque en "timeout" les claims en attente dont l'échéance est dépassée
        \App\Models\InsuranceClaim::where('status','pending')
            ->whereNotNull('response_due_at')
            ->where('response_due_at','<', now())
            ->update(['status'=>'timeout']);

        return back()->with('ok','SLA appliquée: demandes expirées marquées en "timeout".');
    }

}
