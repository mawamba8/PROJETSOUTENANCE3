<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer infos principales du patient
        $prochainRdv = $user->rendezvous()->where('date', '>=', now())->orderBy('date')->first();
        $derniereConsultation = $user->consultations()->latest()->first();

        return view('patient.dashboard', compact('user', 'prochainRdv', 'derniereConsultation'));
    }
}
