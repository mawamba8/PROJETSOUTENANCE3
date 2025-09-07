@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-primary mb-4">Détails du patient : {{ $patient->name }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Email :</strong> {{ $patient->email }}</p>
            <p><strong>Téléphone :</strong> {{ $patient->telephone ?? '-' }}</p>
            <p><strong>Adresse :</strong> {{ $patient->adresse ?? '-' }}</p>
            <p><strong>Date de naissance :</strong> {{ $patient->date_naissance ?? '-' }}</p>
        </div>
    </div>

    <h4 class="mt-4">Consultations</h4>
    <ul class="list-group mt-2">
        @forelse($consultations as $consultation)
            <li class="list-group-item">
                {{ $consultation->date_consultation }} - {{ $consultation->medecin->name ?? 'Médecin inconnu' }}
            </li>
        @empty
            <li class="list-group-item text-muted">Aucune consultation enregistrée.</li>
        @endforelse
    </ul>

    <a href="{{ route('medecin.patients') }}" class="btn btn-secondary mt-3">Retour à la liste des patients</a>
</div>
@endsection
