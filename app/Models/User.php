<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','role','photo','bio'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at'=>'datetime'];

    public function isAdmin(){ return $this->role==='admin'; }
    public function isDoctor(){ return $this->role==='doctor'; }
    public function isPatient(){ return $this->role==='patient'; }

    public function doctorProfile(){ return $this->hasOne(DoctorProfile::class); }
    public function patientProfile(){ return $this->hasOne(PatientProfile::class); }
}
