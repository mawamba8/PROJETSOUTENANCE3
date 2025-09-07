@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le patient</h1>

    <form action="{{ route('medecin.patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $patient->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="form-control" value="{{ old('adresse', $patient->adresse) }}">
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone', $patient->telephone) }}">
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" class="form-control" value="{{ old('date_naissance', $patient->date_naissance) }}">
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('medecin.patients') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
