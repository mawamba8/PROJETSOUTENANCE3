<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $table = 'medecins';

    protected $fillable = [
        'nom', 'prenom', 'specialite', 'telephone', 'email',
    ];

    /** Un médecin a plusieurs rendez-vous */
    public function rendezvous()
    {
        return $this->hasMany(RendezVous::class);
    }
 // 🔗 Un médecin peut avoir plusieurs consultations
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

}