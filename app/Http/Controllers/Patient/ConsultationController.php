<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Auth::user()->consultations()->latest()->get();
        return view('patient.consultations', compact('consultations'));
    }
}
