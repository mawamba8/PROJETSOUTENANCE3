@extends('layouts.app')

    @section('title', 'Tableau de bord')
    @section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-user-injured me-2"></i>Patients</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary">154</h3>
                    <p class="text-muted">Patients enregistrés</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Rendez-vous</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary">8</h3>
                    <p class="text-muted">Aujourd'hui</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-stethoscope me-2"></i>Consultations</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary">327</h3>
                    <p class="text-muted">Ce mois-ci</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-pills me-2"></i>Ordonnances</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary">42</h3>
                    <p class="text-muted">Cette semaine</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Activité récente</h5>
                </div>
                <div class="card-body">
                    <!-- Graphique ou tableau d'activité -->
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="medical-card">
                <div class="card-header-medical">
                    <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Notifications</h5>
                </div>
                <div class="card-body">
                    <!-- Liste des notifications -->
                </div>
            </div>
        </div>
    </div>
@endsection