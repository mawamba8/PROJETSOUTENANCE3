<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PdfController extends Controller
{
     public function generateCarnetMedical()
    {
        $patient = Auth::user();
        
        // Vérifier que l'utilisateur est bien un patient
        if (!$patient->isPatient()) {
            abort(403, 'Accès non autorisé');
        }

        // Récupérer les données du patient
        $consultations = Consultation::where('patient_id', $patient->id)
                                   ->with('medecin')
                                   ->orderBy('date_consultation', 'desc')
                                   ->get();

        $rendezvous = RendezVous::where('patient_id', $patient->id)
                              ->with('medecin')
                              ->orderBy('date_rdv', 'desc')
                              ->get();
 $medecinTraitant = User::find($patient->created_by);

        $data = [
            'patient' => $patient,
            'consultations' => $consultations,
            'rendezvous' => $rendezvous,
            'medecinTraitant' => $medecinTraitant,
            'dateGeneration' => now()->format('d/m/Y à H:i'),
        ];

        $pdf = Pdf::loadView('pdf.carnet-medical', $data);

        return $pdf->download('carnet-medical-' . $patient->code_patient . '.pdf');
    }

    public function previewCarnetMedical()
    {
        $patient = Auth::user();
        
        if (!$patient->isPatient()) {
            abort(403, 'Accès non autorisé');
        }

 $consultations = Consultation::where('patient_id', $patient->id)
                                   ->with('medecin')
                                   ->orderBy('date_consultation', 'desc')
                                   ->get();

        $rendezvous = RendezVous::where('patient_id', $patient->id)
                              ->with('medecin')
                              ->orderBy('date_rdv', 'desc')
                              ->get();

        $medecinTraitant = User::find($patient->created_by);

        return view('pdf.carnet-medical', [
            'patient' => $patient,
            'consultations' => $consultations,
            'rendezvous' => $rendezvous,
            'medecinTraitant' => $medecinTraitant,
            'dateGeneration' => now()->format('d/m/Y à H:i'),
            'preview' => true,
 ]);
    }

}
