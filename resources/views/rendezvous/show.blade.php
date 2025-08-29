@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-info">Détails du Rendez-vous</h1>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Patient :</strong> {{ $rendezvous->patient->nom }}</p>
            <p><strong>Médecin :</strong> {{ $rendezvous->medecin->nom }}</p>
            <p><strong>Date :</strong> {{ $rendezvous->date }}</p>
            <p><strong>Heure :</strong> {{ $rendezvous->heure }}</p>
            <p><strong>Statut :</strong> {{ $rendezvous->statut }}</p>
        </div>
    </div>

    <a href="{{ route('rendezvous.index') }}" class="btn btn-primary mt-3">⬅ Retour à la liste</a>
</div>
@endsection
