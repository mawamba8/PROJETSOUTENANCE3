<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('patient');
    }

    public function dashboard()
    {

        $patient = auth()->user();

        dd($patient);
        $prochainRdv = RendezVous::where('patient_id', $patient->id)
                               ->where('date_rdv', '>=', now())
                               ->orderBy('date_rdv')
                               ->first();

        $consultations = Consultation::where('patient_id', $patient->id)
                                   ->get();
        $rendezvous = [];
        $notifications = [];
        return view('patient.dashboard', compact('prochainRdv', 'consultations', 'rendezvous', 'notifications'));
    }

    public function mesConsultations()
    {
        $consultations = Consultation::where('patient_id', auth()->id())
->with('medecin')
                                   ->orderBy('date_consultation', 'desc')
                                   ->get();

        return view('patient.consultations', compact('consultations'));
    }

    public function mesRendezVous()
    {
        $rendezvous = RendezVous::where('patient_id', auth()->id())
                              ->with('medecin')
                              ->orderBy('date_rdv', 'desc')
                              ->get();

        return view('patient.rendezvous', compact('rendezvous'));
    }

    public function profil()
    {
        $patient = auth()->user();
        return view('patient.profil', compact('patient'));
    }
    public function downloadCarnet()
{
    // Vérifier si le patient a le droit de télécharger son carnet
    if (!auth()->user()->isPatient()) {
        abort(403, 'Accès non autorisé');
    }

    // Logique de téléchargement
    $pdfController = new PdfController();
    return $pdfController->generateCarnetMedical();
}

    public function previewCarnet()
{
    if (!auth()->user()->isPatient()) {
        abort(403, 'Accès non autorisé');
    }

    $pdfController = new PdfController();
    return $pdfController->previewCarnetMedical();
}


}
