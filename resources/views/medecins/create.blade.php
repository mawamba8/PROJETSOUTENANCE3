@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-success">Ajouter un Médecin</h1>

    <form action="{{ route('medecins.store') }}" method="POST">
        @csrf
        @include('medecins.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
