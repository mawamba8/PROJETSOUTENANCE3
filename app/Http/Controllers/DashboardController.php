<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BillingInvoice;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return match ($user->role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient'=> redirect()->route('patient.dashboard'),
            default  => redirect()->route('login'),
        };
    }

    public function admin()
    {
        $today = Carbon::today();

        $totalPatients = User::where('role','patient')->count();
        $totalDoctors  = User::where('role','doctor')->count();

        $rdvToday = Appointment::whereBetween('scheduled_at', [
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay(),
        ])->count();

        // Revenus = factures payées du jour
        $revenusJour = (float) BillingInvoice::whereDate('created_at', $today)
            ->where('status','paid')
            ->sum('amount');

        // Revenus par département (graph)
        $byDept = BillingInvoice::selectRaw('department_id, SUM(amount) as total')
            ->where('status','paid')
            ->groupBy('department_id')
            ->get();

        $chartLabels = $byDept->map(fn($r) => optional($r->department)->name ?? 'Autre');
        $chartData   = $byDept->map(fn($r) => (float) $r->total);

        return view('dashboard.admin', [
            'totalPatients' => $totalPatients,
            'totalDoctors'  => $totalDoctors,
            'rdvToday'      => $rdvToday,
            'revenusJour'   => $revenusJour,
            'chartLabels'   => $chartLabels,
            'chartData'     => $chartData,
        ]);
    }

    public function doctor(){ return view('dashboard.doctor'); }
    public function patient(){ return view('dashboard.patient'); }
}
