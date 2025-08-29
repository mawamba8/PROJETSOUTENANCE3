<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezvous = Auth::user()->rendezvous()->latest()->get();
        $medecins = User::where('role', 'medecin')->get();

        return view('patient.rendezvous', compact('rendezvous', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:users,id',
            'date' => 'required|date|after:today',
        ]);

        RendezVous::create([
            'patient_id' => Auth::id(),
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'statut' => 'en attente',
        ]);

        return redirect()->route('patient.rendezvous')->with('success', 'Rendez-vous demandé avec succès.');
    }
}

