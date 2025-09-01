<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Créer les rôles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'medecin'],
            ['name' => 'patient'],
        ];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);

        }

        // Créer l'administrateur
        $adminRole = Role::firstOrCreate(['name'=>'admin']);
        User::firstOrCreate([
            'email' => 'admin@medical.com'],//condition de recherche
            ['name' => 'Administrateur',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'telephone' => '+1234567890',
        ]);
        // Créer un médecin
        $medecinRole = Role::where('name', 'medecin')->first();
        $medecin = User::firstOrCreate([
            'email' => 'medecin@medical.com'],
            ['name' => 'Dr. Jean Dupont',
            'password' => Hash::make('password'),
            'role_id' => $medecinRole->id,
            'telephone' => '+1234567891',
            'specialite' => 'Médecine générale',
        ]);

        // Créer un patient
        $patientRole = Role::where('name', 'patient')->first();
        User::firstOrCreate([
            'email' => 'patient@medical.com'],
            ['name' => 'Marie Martin',
            'password' => Hash::make('password'),
            'role_id' => $patientRole->id,
             'telephone' => '+1234567892',
            'date_naissance' => '1985-05-15',
            'adresse' => '123 Rue de la Santé, Paris',
            'created_by' => $medecin->id,
        ]);

    }
    
}
