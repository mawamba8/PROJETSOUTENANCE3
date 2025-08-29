<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Consultation extends Model
{
    use HasFactory;

     protected $table = 'consultations';

    protected $fillable = [
           'patient_id','medecin_id','date_consultation', 'diagnostic', 'prescription','observations','poids','taille','temperature','symptomes',
    ];

     protected $casts = [
        'date_consultation' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(User::class,'medecin_id');
    }

}

   

