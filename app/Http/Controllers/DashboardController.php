<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Rendezvous;
use App\Models\Consultation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function patient()
    {
        $user = Auth::user();
        $rendezvous = Rendezvous::where('patient_id', $user->id)->get();
        $consultations = Consultation::where('patient_id', $user->id)->get();
        $notifications = Notification::where('user_id', $user->id)->get();

        return view('dashboard.patient', compact('rendezvous', 'consultations', 'notifications'));
    }

    public function medecin()
    {
        $user = Auth::user();
        $patients = Patient::where('medecin_id', $user->id)->get();
        $rendezvous = Rendezvous::where('medecin_id', $user->id)->get();
        $consultations = Consultation::where('medecin_id', $user->id)->get();
        $notifications = Notification::where('user_id', $user->id)->get();

        return view('dashboard.medecin', compact('patients', 'rendezvous', 'consultations', 'notifications'));
    }

     /*  public function index()
    {
        $patients = Patient::count();
        $doctors = Doctor::count();
        $rendezvous = Rendezvous::count();

        return view('dashboard', compact('patients', 'doctors', 'rendezvous'));
    }
    public function patient()
    {
        return view('dashboards.patient'); // vue pour patient
    }

    public function medecin()
    {
        return view('dashboards.medecin'); // vue pour médecin
    }*/

}