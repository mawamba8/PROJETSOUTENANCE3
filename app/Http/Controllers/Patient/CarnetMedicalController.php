<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DossierMedical;

class CarnetMedicalController extends Controller
{
    /**
     * Affiche le carnet médical du patient connecté
     */
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer son dossier médical (lié au modèle DossierMedical)
        $dossier = DossierMedical::where('patient_id', $user->id)->first();

        // Si aucun dossier médical, on en crée un par défaut
        if (!$dossier) {
            $dossier = DossierMedical::create([
                'patient_id' => $user->id,
                'historique' => 'Aucun antécédent pour le moment.',
            ]);
        }

        // Retourner la vue avec le dossier médical
        return view('patient.carnet', compact('dossier'));
    }
}
