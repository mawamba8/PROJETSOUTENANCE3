<?php

namespace App\Policies;
use App\Models\User;

class PrescriptionPolicy {
    public function create(User $u){ return in_array($u->role, ['admin','doctor']); }
}
