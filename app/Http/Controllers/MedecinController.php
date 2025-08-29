<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedecinController extends Controller
{
    public function __construct()
    {
        $this->middleware('medecin');
    }

    public function dashboard()
    {
        $medecin = auth()->user();
        $patients = User::where('created_by', $medecin->id)
                       ->whereHas('role', function($query) {
                           $query->where('name', 'patient');
                       })->count();

        $rdvs = RendezVous::where('medecin_id', $medecin->id)
                         ->where('date_rdv', '>=', now())
                         ->count();

        $consultations = Consultation::where('medecin_id', $medecin->id)
                                   ->whereDate('created_at', today())
                                   ->count();
        return view('medecin.dashboard', compact('patients', 'rdvs', 'consultations'));
    }

    public function createPatientForm()
    {
        return view('medecin.create-patient');
    }

    public function createPatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|string',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string',
        ]);

        $rolePatient = Role::where('name', 'patient')->first();

        $patient = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Mot de passe par défaut
            'role_id' => $rolePatient->id,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'created_by' => auth()->id(),
        ]);

return redirect()->route('medecin.dashboard')
                       ->with('success', 'Patient créé avec succès. Code: ' . $patient->code_patient);
    }

    public function mesPatients()
    {
        $patients = User::where('created_by', auth()->id())
                       ->whereHas('role', function($query) {
                           $query->where('name', 'patient');
                       })->get();

        return view('medecin.patients', compact('patients'));
    }

    public function showPatient($id)
    {
        $patient = User::where('id', $id)
                      ->where('created_by', auth()->id())
                      ->firstOrFail();

        $consultations = Consultation::where('patient_id', $id)
                                   ->with('medecin')
                                   ->orderBy('date_consultation', 'desc')
                                   ->get();

        return view('medecin.patient-show', compact('patient', 'consultations'));
    }
}

