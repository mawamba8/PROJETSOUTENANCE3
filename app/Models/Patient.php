<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    //protected $table = 'patients';

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'date_naissance',
        'numero_dossier',
        'antecedents_medicaux',
        'traitements_en_cours',
        'email',
        'telephone',
        'sexe',
        'notes'
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

// 🔗 Un patient peut avoir plusieurs consultations
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

 // 🔗 Un patient peut avoir plusieurs rendez-vous
    public function rendezvous()
    {
        return $this->hasMany(RendezVous::class);
    }
    // 🔗 Un patient peut avoir plusieurs carnets médicaux
   /* public function carnetMedical()
    {
        return $this->hasMany(CarnetMedical::class);
    }*/

       // Générer un numéro de carnet unique
    public static function generateNumeroCarnet()
    {
        do {
            $numero = 'PAT' . date('Ymd') . rand(1000, 9999);
        } while (self::where('numero_carnet', $numero)->exists());

        return $numero;
    }
 
}
