<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    // IMPORTANT : la table ne suit pas la pluralisation anglaise
    //protected $table = 'rendezvous';

    protected $fillable = [
        'patient_id', 'medecin_id', 'date_rdv', 'heure_rdv', 'statut','motif','notes','duree','type_consultation',
    ];

    protected $casts = [
        'date_rdv'=> 'date',
        'heure_rdv'=> 'time',
    ];

    const STATUTS = [
        'planifié' => 'Planifié',
        'confirmé' => 'Confirmé',
        'annulé' => 'Annulé',
        'terminé' => 'Terminé',
        'absent' => 'Absent',
    ];

    const TYPES_CONSULTATION = [
        'general' => 'Consultation générale',
        'specialiste' => 'Consultation spécialiste',
        'urgence' => 'Urgence',
        'suivi' => 'Suivi',
        'vaccination' => 'Vaccination',
    ];

    /** Ce RDV appartient à un patient */
    public function patient()
    {
        return $this->belongsTo(Use::class, 'patient_id');
    }

    /** Ce RDV appartient à un médecin */
    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }
  
}


