<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $u = Auth::user();

        // Liste des médecins pour le choix (patient)
        $doctors = User::where('role','doctor')->with('doctorProfile')->orderBy('name')->get();
        $patients = User::where('role','patient')->orderBy('name')->get();

        $q = Appointment::with(['doctor','patient'])
            ->orderByDesc('scheduled_at');

        if($u->isDoctor()){
            $q->where('doctor_id',$u->id);
        } elseif($u->isPatient()){
            $q->where('patient_id',$u->id);
        }
        $list = $q->paginate(10);

        return view('appointments.index', compact('list','doctors','patients','u'));
    }

    // Patient demande / Médecin programme
    public function store(Request $r)
    {
        $u = Auth::user();

        $rules = [
            'doctor_id'=>'required|exists:users,id',
            'scheduled_at'=>'required|date',
            'urgency'=>'required|in:low,normal,high,critical',
        ];

        // Si médecin programme un patient
        if($u->isDoctor()){
            $rules['patient_id'] = 'required|exists:users,id';
        }

        $data = $r->validate($rules);

        $appt = new Appointment();
        $appt->doctor_id   = $data['doctor_id'];
        $appt->patient_id  = $u->isPatient() ? $u->id : $data['patient_id'];
        $appt->scheduled_at= $data['scheduled_at'];
        $appt->urgency     = $data['urgency'];
        $appt->created_by  = $u->id;

        if($u->isDoctor()){
            // RDV imposé par le médecin => confirmé + obligatoire
            $appt->status = 'confirmed';
            $appt->is_mandatory = true;
        }else{
            // Patient demande => en attente
            $appt->status = 'pending';
            $appt->is_mandatory = false;
        }

        $appt->notes = $r->notes;
        $appt->save();

        return back()->with('ok','Rendez-vous enregistré.');
    }

    // Médecin confirme / annule
    public function update(Request $r, Appointment $appointment)
    {
        $u = Auth::user();
        if(!$u->isDoctor() || $appointment->doctor_id !== $u->id) abort(403);

        $r->validate(['action'=>'required|in:confirm,cancel']);

        if($r->action==='confirm'){
            $appointment->status = 'confirmed';
        }else{
            $appointment->status = 'cancelled';
        }
        $appointment->save();

        return back()->with('ok','Statut mis à jour.');
    }

    public function destroy(Appointment $appointment)
    {
        $u = Auth::user();
        // Celui qui a créé peut supprimer sa demande tant que ce n'est pas "done"
        if($appointment->status==='done') abort(403);
        if($u->id !== $appointment->created_by && !$u->isAdmin()) abort(403);
        $appointment->delete();

        return back()->with('ok','Rendez-vous supprimé.');
    }
}
