<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\Department;
use App\Models\Specialty;

class ProfileController extends Controller
{
    public function edit()
    {
        $u = Auth::user();
        $departments = Department::orderBy('name')->get();
        $specialties = Specialty::orderBy('name')->get();
        $doctor = $u->isDoctor() ? DoctorProfile::firstOrCreate(['user_id'=>$u->id]) : null;
        $patient = $u->isPatient() ? PatientProfile::firstOrCreate(['user_id'=>$u->id]) : null;
        return view('profile.edit', compact('u','doctor','patient','departments','specialties'));
    }

    public function update(Request $r)
    {
        $u = Auth::user();

        $r->validate([
            'name'=>'required|string|max:255',
            'email'=>"required|email|unique:users,email,{$u->id}",
            'password'=>'nullable|string|min:4|confirmed',
        ]);

        $u->name = $r->name;
        $u->email = $r->email;
        if($r->password) $u->password = Hash::make($r->password);
        $u->bio = $r->bio;
        $u->save();

        if($u->isDoctor()){
            $doc = DoctorProfile::firstOrCreate(['user_id'=>$u->id]);
            $doc->department_id = $r->department_id ?: null;
            $doc->specialty_id = $r->specialty_id ?: null;
            $doc->phone = $r->phone;
            $doc->about = $r->about;
            $doc->save();
        }

        if($u->isPatient()){
            $p = PatientProfile::firstOrCreate(['user_id'=>$u->id]);
            $p->birthdate = $r->birthdate ?: null;
            $p->sex = $r->sex ?: null;
            $p->address = $r->address;
            $p->blood_group = $r->blood_group;
            $p->allergies = $r->allergies;
            $p->insured = (bool)$r->insured;
            $p->insurer_name = $r->insurer_name;
            $p->policy_number = $r->policy_number;
            $p->save();
        }

        return back()->with('ok','Profil mis à jour.');
    }
}
