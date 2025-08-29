<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isMedecin()) {
            $rendezvous = RendezVous::where('medecin_id', $user->id)
                                  ->with('patient')
                                  ->orderBy('date_rdv', 'desc')
                                  ->paginate(10);
        } elseif ($user->isPatient()) {
            $rendezvous = RendezVous::where('patient_id', $user->id)
                                  ->with('medecin')
                                  ->orderBy('date_rdv', 'desc')
                                  ->paginate(10);
                                   } else {
            $rendezvous = RendezVous::with(['patient', 'medecin'])
                                  ->orderBy('date_rdv', 'desc')
                                  ->paginate(10);
        }

        return view('rendezvous.index', compact('rendezvous'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if ($user->isMedecin()) {
            $patients = User::where('created_by', $user->id)
                          ->whereHas('role', function($query) {
                              $query->where('name', 'patient');
                          })->get();
            $medecins = collect([$user]);
        } elseif ($user->isAdmin()) {
             $patients = User::whereHas('role', function($query) {
                $query->where('name', 'patient');
            })->get();
            $medecins = User::whereHas('role', function($query) {
                $query->where('name', 'medecin');
            })->get();
        } else {
            abort(403, 'Accès non autorisé');
        }

        return view('rendezvous.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'medecin_id' => 'required|exists:users,id',
            'date_rdv' => 'required|date|after:now',
            'motif' => 'required|string|max:500',
            'type_consultation' => 'required|string',
            'duree' => 'required|integer|min:15|max:120',
            'notes' => 'nullable|string',
        ]);

        // Vérifier les conflits de rendez-vous
        $conflict = RendezVous::where('medecin_id', $request->medecin_id)
                            ->where('date_rdv', '<=', $request->date_rdv)
                            ->whereRaw('DATE_ADD(date_rdv, INTERVAL duree MINUTE) > ?', [$request->date_rdv])
                            ->exists();

        if ($conflict) {
            return back()->withErrors(['date_rdv' => 'Le médecin a déjà un rendez-vous à cette heure.']);
        }
        RendezVous::create($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    public function show(RendezVous $rendezVous)
    {
        $this->authorize('view', $rendezVous);
        return view('rendezvous.show', compact('rendezVous'));
    }

    public function edit(RendezVous $rendezVous)
    {
        $this->authorize('update', $rendezVous);
        
        $user = Auth::user();
        if ($user->isMedecin()) {
            $patients = User::where('created_by', $user->id)
            >whereHas('role', function($query) {
                              $query->where('name', 'patient');
                          })->get();
            $medecins = collect([$user]);
        } else {
            $patients = User::whereHas('role', function($query) {
                $query->where('name', 'patient');
            })->get();
            $medecins = User::whereHas('role', function($query) {
                $query->where('name', 'medecin');
            })->get();
        }

        return view('rendezvous.edit', compact('rendezVous', 'patients', 'medecins'));
    }

    public function update(Request $request, RendezVous $rendezVous)
    {
         $this->authorize('update', $rendezVous);

        $request->validate([
            'date_rdv' => 'required|date|after:now',
            'motif' => 'required|string|max:500',
            'type_consultation' => 'required|string',
            'duree' => 'required|integer|min:15|max:120',
            'statut' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $rendezVous->update($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    public function destroy(RendezVous $rendezVous)
    {
         $this->authorize('delete', $rendezVous);
        $rendezVous->delete();

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }

    public function confirm(RendezVous $rendezVous)
    {
        $this->authorize('update', $rendezVous);
        $rendezVous->update(['statut' => 'confirmé']);

        return back()->with('success', 'Rendez-vous confirmé.');
    }

    public function cancel(RendezVous $rendezVous)
    {
        $this->authorize('update', $rendezVous);
         $rendezVous->update(['statut' => 'annulé']);

        return back()->with('success', 'Rendez-vous annulé.');
    }
}








