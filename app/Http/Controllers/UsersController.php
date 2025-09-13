<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Specialty;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private function ensureAdmin()
    {
        abort_unless(auth()->user()?->isAdmin(), 403, 'Réservé à l’admin');
    }

    public function createDoctor()
    {
        $this->ensureAdmin();
        $departments = Department::orderBy('name')->get();
        $specialties = Specialty::orderBy('name')->get();

        return view('admin.users.create_doctor', compact('departments','specialties'));
    }

    public function storeDoctor(Request $r)
    {
        $this->ensureAdmin();

        $data = $r->validate([
            'name'          => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'nullable|min:6',
            'department_id' => 'required|exists:departments,id',
            'specialty_id'  => 'required|exists:specialties,id',
            'phone'         => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => 'doctor',
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);

        DoctorProfile::create([
            'user_id'       => $user->id,
            'department_id' => $data['department_id'],
            'specialty_id'  => $data['specialty_id'],
            'phone'         => $data['phone'] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('ok','Médecin créé (mot de passe par défaut: "password" si non fourni).');
    }

    public function createPatient()
    {
        $this->ensureAdmin();
        // Pas besoin de listes pour patient
        return view('admin.users.create_patient');
    }

    public function storePatient(Request $r)
    {
        $this->ensureAdmin();

        $data = $r->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'nullable|min:6',
            'sex'       => 'nullable|in:M,F',
            'birthdate' => 'nullable|date',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => 'patient',
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);

        PatientProfile::create([
            'user_id'   => $user->id,
            'sex'       => $data['sex'] ?? null,
            'birthdate' => $data['birthdate'] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('ok','Patient créé (mot de passe par défaut: "password" si non fourni).');
    }

    // --- AJOUT DANS UsersController ---

public function createPatientByDoctor()
{
    abort_unless(auth()->user()?->isDoctor() || auth()->user()?->isAdmin(), 403);

    // Formulaire simple (le médecin n’a pas besoin de listes)
    return view('doctor.patients.create');
}

public function storePatientByDoctor(Request $r)
{
    abort_unless(auth()->user()?->isDoctor() || auth()->user()?->isAdmin(), 403);

    $data = $r->validate([
        'name'      => 'required|string',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'nullable|min:6',
        'sex'       => 'nullable|in:M,F',
        'birthdate' => 'nullable|date',
    ]);

    $user = \App\Models\User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'role'     => 'patient',
        'password' => \Illuminate\Support\Facades\Hash::make($data['password'] ?? 'password'),
    ]);

    \App\Models\PatientProfile::create([
        'user_id'   => $user->id,
        'sex'       => $data['sex'] ?? null,
        'birthdate' => $data['birthdate'] ?? null,
    ]);

    return redirect()->route('doctor.dashboard')->with('ok', 'Patient créé.');
}


}
