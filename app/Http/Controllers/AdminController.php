<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $medecins = User::whereHas('role', function ($query) {
            $query->where('name', 'medecin');
        })->count();

        $patients = User::whereHas('role', function ($query) {
            $query->where('name', 'patient');
        })->count();

        return view('admin.dashboard', compact('medecins', 'patients'));
    }

    public function createMedecinForm()
    {
        return view('admin.create-medecin');
    }

    public function createMedecin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'telephone' => 'required|string',
            'specialite' => 'required|string',
        ]);

        $roleMedecin = Role::where('name', 'medecin')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleMedecin->id,
            'telephone' => $request->telephone,
            'specialite' => $request->specialite,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Compte médecin créé avec succès');
    }

    public function createPatientForm()
    {
        return view('admin.create-patient');
    }

    public function createPatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'telephone' => 'required|string',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string',
        ]);

        $rolePatient = Role::where('name', 'patient')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $rolePatient->id,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Compte patient créé avec succès');
    }

    public function listeMedecins()
    {
        $medecins = User::whereHas('role', function ($query) {
            $query->where('name', 'medecin');
        })->get();

        return view('admin.medecins', compact('medecins'));
    }

    public function listePatients()
    {
        $patients = User::whereHas('role', function ($query) {
            $query->where('name', 'patient');
        })->get();

        return view('admin.patients', compact('patients'));
    }

    public function showMedecin($id)
    {
        $medecin = User::whereHas('role', function ($query) {
            $query->where('name', 'medecin');
        })->findOrFail($id);

        $patients = User::where('created_by', $id)
            ->whereHas('role', function ($query) {
                $query->where('name', 'patient');
            })->count();

        return view('admin.medecin-show', compact('medecin', 'patients'));
    }

    public function showPatient($id)
    {
        $patient = User::whereHas('role', function ($query) {
            $query->where('name', 'patient');
        })->findOrFail($id);

        $consultations = Consultation::where('patient_id', $id)
            ->with('medecin')
            ->orderBy('date_consultation', 'desc')
            ->get();

        return view('admin.patient-show', compact('patient', 'consultations'));


    }
}
