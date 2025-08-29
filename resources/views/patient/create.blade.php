@extends('layouts.app')

@section('content')
<h3>Ajouter un Patient</h3>

<form action="{{ route('patients.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prenom</label>
        <input type="text" name="prenom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Téléphone</label>
        <input type="text" name="telephone" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Enregistrer</button>
</form>
@endsection