@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-info">Détails de la Consultation</h1>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Patient :</strong> {{ $consultation->patient->nom }}</p>
            <p><strong>Médecin :</strong> {{ $consultation->medecin->nom }}</p>
            <p><strong>Rendez-vous :</strong> {{ $consultation->rendezvous->date }} à {{ $consultation->rendezvous->heure }}</p>
            <p><strong>Diagnostic :</strong> {{ $consultation->diagnostic }}</p>
            <p><strong>Traitement :</strong> {{ $consultation->traitement }}</p>
        </div>
    </div>

    <a href="{{ route('consultations.index') }}" class="btn btn-primary mt-3">⬅ Retour à la liste</a>
</div>
@endsection
