<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Specialty;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\Insurance;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // Roles simples via champ 'role' (déjà en place)
    $admin = \App\Models\User::firstOrCreate(
        ['email'=>'admin@cmn.local'],
        ['name'=>'Admin','role'=>'admin','password'=>Hash::make('password')]
    );

    $patient = \App\Models\User::firstOrCreate(
        ['email'=>'patient@cmn.local'],
        ['name'=>'John Patient','role'=>'patient','password'=>Hash::make('password')]
    );

    // Taxo de base
    $depGen = \App\Models\Department::firstOrCreate(['name'=>'Médecine générale'],['description'=>'Soins primaires']);
    $depCard = \App\Models\Department::firstOrCreate(['name'=>'Cardiologie']);
    $depOpht = \App\Models\Department::firstOrCreate(['name'=>'Ophtalmologie']);
    $sGen = \App\Models\Specialty::firstOrCreate(['department_id'=>$depGen->id,'name'=>'Généraliste']);
    $sCard = \App\Models\Specialty::firstOrCreate(['department_id'=>$depCard->id,'name'=>'Cardiologie']);
    $sOpht = \App\Models\Specialty::firstOrCreate(['department_id'=>$depOpht->id,'name'=>'Ophtalmologie']);

    // 2 médecins démos
    $dr1 = \App\Models\User::firstOrCreate(
        ['email'=>'dr@cmn.local'],
        ['name'=>'Dr House','role'=>'doctor','password'=>Hash::make('password')]
    );
    \App\Models\DoctorProfile::firstOrCreate(
        ['user_id'=>$dr1->id],
        ['department_id'=>$depCard->id,'specialty_id'=>$sCard->id,'phone'=>'+237600000000']
    );

    $dr2 = \App\Models\User::firstOrCreate(
        ['email'=>'dr.opht@cmn.local'],
        ['name'=>'Dr Vision','role'=>'doctor','password'=>Hash::make('password')]
    );
    \App\Models\DoctorProfile::firstOrCreate(
        ['user_id'=>$dr2->id],
        ['department_id'=>$depOpht->id,'specialty_id'=>$sOpht->id,'phone'=>'+237699999999']
    );

    \App\Models\PatientProfile::firstOrCreate(['user_id'=>$patient->id],[
        'sex'=>'M','blood_group'=>'O+','insured'=>true,'insurer_name'=>'CMN Assurance','policy_number'=>'CMN-12345'
    ]);

    \App\Models\Insurance::firstOrCreate(['name'=>'CMN Assurance'],['email'=>'claims@cmn.local']);
}

}
