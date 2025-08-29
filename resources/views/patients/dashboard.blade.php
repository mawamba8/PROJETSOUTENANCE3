@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de bord Patient</div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Votre code patient:</strong> {{ auth()->user()->code_patient }}
                    </div>

                    @if($prochainRdv)
                    <div class="alert alert-success">
                        <h5>Prochain rendez-vous</h5>
                        <p><strong>Date:</strong> {{ $prochainRdv->date_rdv->format('d/m/Y H:i') }}</p>
                        <p><strong>Médecin:</strong> {{ $prochainRdv->medecin->name }}</p>
                        <p><strong>Motif:</strong> {{ $prochainRdv->motif }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h3>{{ $consultations }}</h3>
                                    <p>Consultations</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('patient.consultations') }}" class="btn btn-primary">
                            Mes consultations
                        </a>
                        <a href="{{ route('patient.rendezvous') }}" class="btn btn-secondary">
                            Mes rendez-vous
                        </a>
                        <a href="{{ route('patient.profil') }}" class="btn btn-info">
                            Mon profil
                        </a>
                        <a href="{{ route('patient.preview.carnet') }}" class="btn btn-warning">
                            📄 Voir mon carnet médical
                        </a>
                        <a href="{{ route('patient.download.carnet') }}" class="btn btn-danger">
                             ⬇ Télécharger mon carnet (PDF)
                         </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
