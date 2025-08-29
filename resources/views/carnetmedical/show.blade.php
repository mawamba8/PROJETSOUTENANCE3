@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-info">Carnet Médical du Patient</h1>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Patient :</strong> {{ $carnetmedical->patient->nom }}</p>
            <p><strong>Antécédents :</strong> {{ $carnetmedical->antecedents }}</p>
            <p><strong>Allergies :</strong> {{ $carnetmedical->allergies }}</p>
            <p><strong>Notes :</strong> {{ $carnetmedical->notes }}</p>
        </div>
    </div>

    <a href="{{ route('carnetmedicals.index') }}" class="btn btn-primary mt-3">⬅ Retour à la liste</a>
</div>
@endsection
