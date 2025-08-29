<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isMedecin()) {
            $consultations = Consultation::where('medecin_id', $user->id)
                                       ->with('patient')
                                       ->orderBy('date_consultation', 'desc')
                                       ->paginate(10);
        } elseif ($user->isPatient()) {
            $consultations = Consultation::where('patient_id', $user->id)
                                       ->with('medecin')
                                       ->orderBy('date_consultation', 'desc')
                                       ->paginate(10);
        } else {
            $consultations = Consultation::with(['patient', 'medecin'])
                                       ->orderBy('date_consultation', 'desc')
                                       ->paginate(10);
        }

        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if ($user->isMedecin()) {
            $patients = User::where('created_by', $user->id)
                          ->whereHas('role', function($query) {
                              $query->where('name', 'patient');
                          })->get();
        } elseif ($user->isAdmin()) {
            $patients = User::whereHas('role', function($query) {
                $query->where('name', 'patient');
            })->get();
        } else {
            abort(403, 'Accès non autorisé');
        }

        $rendezvous = RendezVous::where('statut', 'planifié')
                              ->where('medecin_id', $user->id)
                              ->with('patient')
                              ->get();

        return view('consultations.create', compact('patients', 'rendezvous'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'patient_id' => 'required|exists:users,id',
            'date_consultation' => 'required|date',
            'diagnostic' => 'required|string',
            'prescription' => 'required|string',
            'poids' => 'nullable|numeric|min:0|max:300',
            'taille' => 'nullable|numeric|min:0|max:250',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'symptomes' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        $consultation = Consultation::create([
            'patient_id' => $request->patient_id,
            'medecin_id' => Auth::id(),
            'date_consultation' => $request->date_consultation,
            'diagnostic' => $request->diagnostic,
            'prescription' => $request->prescription,
            'poids' => $request->poids,
            'taille' => $request->taille,
            'temperature' => $request->temperature,
            'symptomes' => $request->symptomes,
            'observations' => $request->observations,
        ]);

        // Marquer le rendez-vous comme terminé si applicable
        if ($request->has('rendez_vous_id')) {
            RendezVous::where('id', $request->rendez_vous_id)
                     ->update(['statut' => 'terminé']);
        }

        return redirect()->route('consultations.show', $consultation)
                       ->with('success', 'Consultation enregistrée avec succès.');
    }
     public function show(Consultation $consultation)
    {
        $this->authorize('view', $consultation);
        return view('consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $this->authorize('update', $consultation);
        
        $patients = User::whereHas('role', function($query) {
            $query->where('name', 'patient');
        })->get();

        return view('consultations.edit', compact('consultation', 'patients'));
    }
    public function update(Request $request, Consultation $consultation)
    {
        $this->authorize('update', $consultation);

        $request->validate([
            'date_consultation' => 'required|date',
            'diagnostic' => 'required|string',
            'prescription' => 'required|string',
            'poids' => 'nullable|numeric|min:0|max:300',
            'taille' => 'nullable|numeric|min:0|max:250',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'symptomes' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        $consultation->update($request->all());
         return redirect()->route('consultations.show', $consultation)
                       ->with('success', 'Consultation mise à jour avec succès.');
    }

    public function destroy(Consultation $consultation)
    {
        $this->authorize('delete', $consultation);
        $consultation->delete();

        return redirect()->route('consultations.index')->with('success', 'Consultation supprimée avec succès.');
    }
}












