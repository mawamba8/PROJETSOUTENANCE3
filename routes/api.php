<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/



// Statistiques du dashboard
Route::get('/dashboard/stats', function (Request $request) {
    return response()->json([
        'total_patients' => \App\Models\Patient::count(),
        'today_appointments' => \App\Models\Appointment::whereDate('appointment_date', today())->count(),
        'monthly_consultations' => \App\Models\Consultation::whereMonth('created_at', now()->month)->count(),
        'emergencies' => \App\Models\Appointment::where('is_emergency', true)
            ->whereDate('appointment_date', today())
            ->count()
    ]);
});

// Recherche en temps réel
Route::get('/search', function (Request $request) {
    $query = $request->get('q');
    
    $results = [];
    
    // Recherche patients
    $patients = \App\Models\Patient::where('first_name', 'like', "%{$query}%")
        ->orWhere('last_name', 'like', "%{$query}%")
        ->limit(5)
        ->get()
        ->map(function($patient) {
            return [
                'id' => $patient->id,
                'type' => 'patient',
                'title' => $patient->full_name,
                'description' => $patient->email . ' - ' . $patient->phone,
                'date' => $patient->created_at->format('d/m/Y')
            ];
        });
    
    $results = array_merge($results, $patients->toArray());
    
    return response()->json($results);
});

// Notifications
Route::get('/notifications', function (Request $request) {
    $notifications = $request->user()->notifications()
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
    
    return response()->json([
        'notifications' => $notifications,
        'unread_count' => $request->user()->unreadNotifications()->count()
    ]);
});

Route::post('/notifications/{notification}/read', function (Request $request, $notificationId) {
    $notification = $request->user()->notifications()->find($notificationId);
    if ($notification) {
        $notification->markAsRead();
    }
    
    return response()->json(['success' => true]);
});

// Événements calendrier
Route::get('/calendar/events', function (Request $request) {
    $appointments = \App\Models\Appointment::with('patient')
        ->where('appointment_date', '>=', now()->subMonth())
        ->get()
        ->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->patient->full_name . ' - ' . $appointment->reason,
                'start' => $appointment->appointment_date,
                'end' => $appointment->appointment_date->addHour(),
                'color' => $appointment->is_emergency ? '#dc2626' : '#2563eb'
            ];
        });
    
    return response()->json($appointments);
});