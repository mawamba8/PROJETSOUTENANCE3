@extends('layouts.app')

@section('content')
<h2>Détails Patient</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>Nom:</strong> {{ $patient->nom }}</li>
    <li class="list-group-item"><strong>Prénom:</strong> {{ $patient->prenom }}</li>
    <li class="list-group-item"><strong>Date naissance:</strong> {{ $patient->date_naissance }}</li>
    <li class="list-group-item"><strong>Adresse:</strong> {{ $patient->adresse }}</li>
    <li class="list-group-item"><strong>Téléphone:</strong> {{ $patient->telephone }}</li>
</ul>
<a href="{{ route('patients.index') }}" class="btn btn-primary mt-3">Retour</a>
@endsection

