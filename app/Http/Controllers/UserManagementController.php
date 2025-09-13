<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // --- Afficher formulaire création patient (Admin ou Médecin) ---
    public function createPatient()
    {
        $this->authorizeCreate('patient');
        return view('users.create_patient');
    }

    // --- Enregistrer patient ---
    public function storePatient(Request $r)
    {
        $this->authorizeCreate('patient');

        $data = $r->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6',
            'sex' => 'nullable|in:M,F',
            'birthdate' => 'nullable|date',
        ]);

        $u = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'role' => 'patient',
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);

        PatientProfile::create([
            'user_id' => $u->id,
            'sex' => $data['sex'] ?? null,
            'birthdate' => $data['birthdate'] ?? null,
        ]);

        return redirect()->route('patient.dashboard')->with('ok', 'Patient créé');
    }

    // --- Afficher formulaire création médecin (Admin only) ---
    public function createDoctor()
    {
        $this->authorizeCreate('doctor');
        $departments = Department::orderBy('name')->get();
        return view('users.create_doctor', compact('departments'));
    }

    // --- Enregistrer médecin ---
    public function storeDoctor(Request $r)
    {
        $this->authorizeCreate('doctor');

        $data = $r->validate([
            'name' => 'required|string|max:190',
            'email'=> 'required|email|unique:users,email',
            'password'=>'nullable|min:6',
            'department_id'=>'nullable|exists:departments,id',
            'phone'=>'nullable|string|max:50',
        ]);

        $u = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'role' => 'doctor',
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);

        DoctorProfile::create([
            'user_id' => $u->id,
            'department_id' => $data['department_id'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);

        return redirect()->route('doctor.dashboard')->with('ok', 'Médecin créé');
    }

    private function authorizeCreate(string $targetRole): void
    {
        $me = Auth::user();
        // Admin peut tout créer ; Médecin peut créer un Patient uniquement
        if ($me->role === 'admin') return;
        if ($me->role === 'doctor' && $targetRole === 'patient') return;

        abort(403, "Action non autorisée");
    }
}
