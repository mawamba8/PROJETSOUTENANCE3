@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-info">Détails du Médecin</h1>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $medecin->nom }}</p>
            <p><strong>Spécialité :</strong> {{ $medecin->specialite }}</p>
            <p><strong>Email :</strong> {{ $medecin->email }}</p>
            <p><strong>Téléphone :</strong> {{ $medecin->telephone }}</p>
        </div>
    </div>

    <a href="{{ route('medecins.index') }}" class="btn btn-primary mt-3">⬅ Retour à la liste</a>
</div>
@endsection

