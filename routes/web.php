<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
    return view('accueil');
})->name('accueil');

// Route vers le welcome
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.page');

/*
|--------------------------------------------------------------------------
| Auth (public)
|--------------------------------------------------------------------------
*/
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| App (protégé)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Page d’accueil → redirige vers le bon dashboard selon le rôle
   // Route::get('/', fn () => redirect('/dashboard'));
    Route::get('/home', fn () => redirect('/dashboard'))->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboards par rôle
    Route::get('/admin',  [DashboardController::class,'admin'])->name('admin.dashboard');
    Route::get('/doctor', [DashboardController::class,'doctor'])->name('doctor.dashboard');
    Route::get('/patient',[DashboardController::class,'patient'])->name('patient.dashboard');

    /*
    |----------------------------------------------------------------------
    | Rendez-vous
    |----------------------------------------------------------------------
    */
    Route::resource('appointments', AppointmentController::class)
        ->only(['index','store','update','destroy']);

    /*
    |----------------------------------------------------------------------
    | Dossier médical
    |----------------------------------------------------------------------
    */
    Route::get('records/{patient}',       [MedicalRecordController::class,'show'])->name('records.show');
    Route::post('records/{patient}',      [MedicalRecordController::class,'store'])->name('records.store');
    Route::post('records/{record}/lock',  [MedicalRecordController::class,'lock'])->name('records.lock');

    /*
    |----------------------------------------------------------------------
    | Ordonnances
    |----------------------------------------------------------------------
    | NB: ordre important -> 'create' avant '{id}'
    */
    Route::get('prescriptions',               [PrescriptionController::class,'index'])->name('prescriptions.index');
    Route::get('prescriptions/create',        [PrescriptionController::class,'create'])->name('prescriptions.create');
    Route::post('prescriptions',              [PrescriptionController::class,'store'])->name('prescriptions.store');
    Route::get('prescriptions/{id}',          [PrescriptionController::class,'show'])->name('prescriptions.show');
    Route::get('prescriptions/{id}/pdf',      [PrescriptionController::class,'pdf'])->name('prescriptions.pdf');

    /*
    |----------------------------------------------------------------------
    | Facturation
    |----------------------------------------------------------------------
    */
    Route::get('billing',  [BillingController::class,'index'])->name('billing.index');
    Route::post('billing', [BillingController::class,'store'])->name('billing.store');
    Route::patch('billing/{invoice}/status', [BillingController::class,'updateStatus'])->name('billing.updateStatus');


    /*
    |----------------------------------------------------------------------
    | Assurance (SLA 24h)
    |----------------------------------------------------------------------
    */
    Route::get('insurance',                 [InsuranceController::class,'index'])->name('insurance.index');
    Route::post('insurance/claim',          [InsuranceController::class,'createClaim'])->name('insurance.claim');
    Route::get('insurance/mark-timeouts',   [InsuranceController::class,'markTimeouts'])->name('insurance.markTimeouts');

    /*
    |----------------------------------------------------------------------
    | Transferts
    |----------------------------------------------------------------------
    */
    Route::get('transfers', [TransferController::class,'index'])->name('transfers.index');
    Route::post('transfers',[TransferController::class,'store'])->name('transfers.store');

    /*
    |----------------------------------------------------------------------
    | Carte des pharmacies
    |----------------------------------------------------------------------
    */
    Route::view('pharmacies/map', 'map.pharmacies')->name('pharmacies.map');

    /*
    |----------------------------------------------------------------------
    | Gestion utilisateurs
    |----------------------------------------------------------------------
    | Admin : création médecin/patient
    */
    Route::get('admin/users/create/doctor',  [UsersController::class,'createDoctor'])->name('users.create.doctor');
    Route::post('admin/users/store/doctor',  [UsersController::class,'storeDoctor'])->name('users.store.doctor');

    Route::get('admin/users/create/patient', [UsersController::class,'createPatient'])->name('users.create.patient');
    Route::post('admin/users/store/patient', [UsersController::class,'storePatient'])->name('users.store.patient');

    // Médecin : création rapide d’un patient
    Route::get('doctor/patients/create',     [UsersController::class,'createPatientByDoctor'])->name('doctor.patients.create');
    Route::post('doctor/patients',           [UsersController::class,'storePatientByDoctor'])->name('doctor.patients.store');

    /*
    |----------------------------------------------------------------------
    | Profil (édition par l’utilisateur connecté)
    |----------------------------------------------------------------------
    */
    Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::post('profile',[ProfileController::class,'update'])->name('profile.update');
});
