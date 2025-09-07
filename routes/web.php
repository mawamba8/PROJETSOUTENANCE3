<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Rendez_VousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\Carnet_MedicalController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return view('welcome');
})->name('welcome');

// Auth routes
Auth::routes();


// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Redirection après login
Route::get('/redirect-after-login', function () {
    $user = Auth::user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isMedecin()) {
        return redirect()->route('medecin.dashboard');
    } elseif ($user->isPatient()) {
        return redirect()->route('patient.dashboard');
    }

    return redirect('/home');
})->name('redirect.after.login');

/*
|-------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/create-medecin', [AdminController::class, 'createMedecinForm'])->name('admin.create.medecin');
    Route::post('/create-medecin', [AdminController::class, 'createMedecin'])->name('admin.create.medecin.store');
    Route::get('/create-patient', [AdminController::class, 'createPatientForm'])->name('admin.create.patient');
    Route::post('/create-patient', [AdminController::class, 'createPatient'])->name('admin.create.patient.store');


    Route::get('/medecins', [AdminController::class, 'listeMedecins'])->name('admin.medecins');
    Route::get('/medecins/{id}', [AdminController::class, 'showMedecin'])->name('admin.medecin.show');
    Route::get('/patients', [AdminController::class, 'listePatients'])->name('admin.patients');
    Route::get('/patients/{id}', [AdminController::class, 'showPatient'])->name('admin.patient.show');
});

/*
|--------------------------------------------------------------------------
| Médecin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('medecin')->middleware(['auth', 'medecin'])->group(function () {

    Route::get('/dashboard', [MedecinController::class, 'dashboard'])->name('medecin.dashboard');
    Route::get('/create-patient', [MedecinController::class, 'createPatientForm'])->name('medecin.create.patient');
    Route::post('/create-patient', [MedecinController::class, 'createPatient'])->name('medecin.create.patient.store');
    Route::get('/patients', [MedecinController::class, 'mesPatients'])->name('medecin.patients');
    Route::get('/patients/{id}', [MedecinController::class, 'showPatient'])->name('medecin.patient.show');
    
});


/*
|--------------------------------------------------------------------------
| Patient Routes
|--------------------------------------------------------------------------
*/
Route::prefix('patient')->middleware(['auth', 'patient'])->group(function () {

    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/consultations', [PatientController::class, 'mesConsultations'])->name('patient.consultations');
    Route::get('/rendezvous', [PatientController::class, 'mesRendezVous'])->name('patient.rendezvous');
    Route::get('/profil', [PatientController::class, 'profil'])->name('patient.profil');
    Route::get('/carnet/preview', [PatientController::class, 'previewCarnet'])->name('patient.preview.carnet');
    Route::get('/carnet/download', [PatientController::class, 'downloadCarnet'])->name('patient.download.carnet');
    Route::get('/patients',[PatientController::class,'index'])->name('patients.index');

});


/*// Routes Rendez-vous
Route::resource('rendezvous', RendezVousController::class)->middleware('auth');
Route::post('rendezvous/{rendezVous}/confirm', [RendezVousController::class, 'confirm'])->name('rendezvous.confirm')->middleware('auth');
Route::post('rendezvous/{rendezVous}/cancel', [RendezVousController::class, 'cancel'])->name('rendezvous.cancel')->middleware('auth');

// Routes Consultations
Route::resource('consultations', ConsultationController::class)->middleware('auth');*/

Route::get('/medecins',[MedecinController::class,'index'])->name('medecins.index');
Route::post('/medecins',[MedecinController::class,'store'])->name('medecins.store');

Route::get('/patients',[PatientController::class,'index'])->name('patients.index');
Route::post('/patients',[PatientController::class,'store'])->name('patients.store');

Route::get('/rendezvous',[Rendez_VousController::class,'index'])->name('rendezvous.index');
Route::post('/rendezvous',[Rendez_VousController::class,'store'])->name('rendezvous.store');

Route::get('/consultations',[ConsultationController::class,'index'])->name('consultations.index');
Route::post('/consultations',[ConsultationController::class,'store'])->name('consultations.store');

/*Route::get('/traitements',[TraitementsController::class,'index'])->name('traitements.index');
Route::post('/traitements',[TraitementsController::class,'store'])->name('traitements.store');

Route::get('/carnets',[CarnetsController::class,'index'])->name('carnets.index');
Route::post('/carnets',[CarnetsController::class,'store'])->name('carnets.store');*/



Route::get('/profil',[ProfilController::class,'index'])->name('profil.index');
Route::post('/profil/edit',[ProfilController::class,'edit'])->name('profil.edit');
Route::put('/profil/{profil}',[ProfilController::class,'update'])->name('profil.update');

Route::get('/medecins/create',[MedecinController::class,'create'])->name('medecins.create');
Route::get('/medecins/{medecin}/edit',[MedecinController::class,'edit'])->name('medecins.edit');
Route::put('/medecins/{medecin}',[MedecinController::class,'update'])->name('medecins.update');
Route::delete('/medecins/{medecin}',[MedecinController::class,'destroy'])->name('medecins.destroy');
Route::get('/medecins/{medecin}',[MedecinController::class,'show'])->name('medecins.show');

Route::get('/patients/create',[PatientController::class,'create'])->name('patients.create');
Route::get('/patients/{patient}/edit',[PatientController::class,'edit'])->name('patients.edit');
Route::put('/patients/{patient}',[PatientController::class,'update'])->name('patients.update');
Route::delete('/patients/{patient}',[PatientController::class,'destroy'])->name('patients.destroy');
Route::get('/patients/{patient}',[PatientController::class,'show'])->name('patients.show');



/*Route::get('/rendezvous/create', [RendezvouSController::class, 'create'])->name('rendezvous.create');
Route::get('/rendezvous/{id}', [RendezvouSController::class, 'show'])->name('rendezvous.show');
Route::get('/rendezvous/{id}/edit', [RendezvouSController::class, 'edit'])->name('rendezvous.edit');
Route::put('/rendezvous/{id}', [RendezvouSController::class, 'update'])->name('rendezvous.update');
Route::delete('/rendezvous/{id}', [RendezvouSController::class, 'destroy'])->name('rendezvous.destroy');*/

Route::get('/consultations/create',[ConsultationController::class,'create'])->name('consultations.create');
Route::get('/consultations/{consultation}/edit',[ConsultationController::class,'edit'])->name('consultations.edit');
Route::put('/consultations/{consultation}',[ConsultationController::class,'update'])->name('consultations.update');
Route::delete('/consultations/{consultation}',[ConsultationController::class,'destroy'])->name('consultations.destroy');
Route::get('/consultations/{consultation}',[ConsultationController::class,'show'])->name('consultations.show');
/*
Route::get('/carnets/create',[CarnetsController::class,'create'])->name('carnets.create');
Route::get('/carnets/{carnet}/edit',[CarnetsController::class,'edit'])->name('carnets.edit');
Route::put('/carnets/{carnet}',[CarnetsController::class,'update'])->name('carnets.update');
Route::delete('/carnets/{carnet}',[CarnetsController::class,'destroy'])->name('carnets.destroy');
Route::get('/carnets/{carnet}',[CarnetsController::class,'show'])->name('carnets.show');*/


Route::resource('rendezvous', Rendez_VousController::class)->middleware('auth');
Route::resource('consultations', ConsultationController::class)->middleware('auth');
Route::resource('traitements', TraitementController::class)->middleware('auth');
Route::resource('carnets', Carnet_MedicalController::class)->middleware('auth');
Route::resource('profil', ProfilController::class)->middleware('auth');



// Dashboard générique
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';
