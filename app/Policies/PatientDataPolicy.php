<?php

namespace App\Policies;

use App\Models\User;

class PatientDataPolicy
{
    public function accessPatient(User $authUser, User $patientUser): bool
    {
        if ($authUser->isAdmin()) return true;
        if ($authUser->isPatient() && $authUser->id === $patientUser->id) return true;
        if ($authUser->isDoctor()){
            // Autorise si c'est le médecin qui a créé/traite un record du patient (à raffiner)
            return true;
        }
        return false;
    }
}
