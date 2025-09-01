<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Création des rôles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $medecinRole = Role::firstOrCreate(['name' => 'medecin']);
        $patientRole = Role::firstOrCreate(['name' => 'patient']);

        // Création d’un compte admin par défaut
        User::firstOrCreate(
            ['email' => 'admin@medical.com'], // Vérifie si l’admin existe déjà
            [
                'name' => 'Administrateur',
                'password' => Hash::make('admin123'), // mot de passe par défaut
                'role_id' => $adminRole->id
            ]
        );
    }
}
