<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_patient',
        'name',
        'email',
        'password',
        'role_id',
        'telephone',
        'date_naissance',
        'adresse',
        'specialite',
        'created_by'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Vérifie si l’utilisateur est admin.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->role && $user->name === 'patient' && empty($user->code_patient)) {
                $user->code_patient = 'PAT' . Str::upper(Str::random(8));
            }
        });
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    /**
     * Vérifie si l’utilisateur est médecin.
     */
    public function isMedecin()
    {
         return $this->role_id === 2;
    }

    /**
     * Vérifie si l’utilisateur est patient.
     */
    public function isPatient()
    {
        return $this->role_id === 3;
    }

    // Relation pour les médecins qui créent des patients
    public function patientsCreated()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    // Relation pour les patients créés par un médecin
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //model rendez-vous et consultations
    public function medecin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }

    public function rendezvous()
    {
        return $this->hasMany(RendezVous::class, 'patient_id');
    }
}




