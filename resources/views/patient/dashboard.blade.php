@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord - Patient</h1>

    <div class="row">
        <!-- Rendez-vous -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Mes Rendez-vous</div>
                <div class="card-body">
                    @foreach($rendezvous as $rdv)
                        <p>{{ $rdv->date }} avec Dr. {{ $rdv->medecin->name }}</p>
                    @endforeach
                    <a href="{{ route('rendezvous.create') }}" class="btn btn-primary">Prendre un rendez-vous</a>
                </div>
            </div>
        </div>

        <!-- Carnet médical -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Mon Carnet Médical</div>
                <div class="card-body">
                    @foreach($consultations as $consultation)
                        <p>{{ $consultation->date }} - {{ $consultation->diagnostic }}</p>
                    @endforeach
                    <a href="{{ route('consultations.index') }}" class="btn btn-success">Voir tout</a>
                </div>
            </div>
        </div>
</div>

    <!-- Notifications -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mes Notifications</div>
                <div class="card-body">
                    @foreach($notifications as $notif)
                        <p>{{ $notif->message }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
