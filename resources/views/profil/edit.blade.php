@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Profil</h1>

    <form action="{{ route('patients.update',$patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('patients.form')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="Nom Actuel">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" id="email" name="email" class="form-control" value="email@exemple.com">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection

