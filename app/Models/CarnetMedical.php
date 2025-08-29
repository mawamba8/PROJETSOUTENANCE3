<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnetMedical extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultation-id',
        'historique',
        'antecedents',
    ];

    /** Le carnet médical appartient à un patient */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

     public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
