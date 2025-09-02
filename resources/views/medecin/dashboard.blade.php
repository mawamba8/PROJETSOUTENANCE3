@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Tableau de bord Médecin</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $patients }}</h5>
                                    <p class="card-text">Patients</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $rdvs }}</h5>
                                    <p class="card-text">Rendez-vous à venir</p>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $consultations }}</h5>
                                    <p class="card-text">Consultations aujourd'hui</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('medecin.create.patient') }}" class="btn btn-primary">
                            Créer un nouveau patient
                        </a>
                        <a href="{{ route('medecin.patients') }}" class="btn btn-secondary">
                            Voir mes patients
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
