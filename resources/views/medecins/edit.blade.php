@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-warning">Modifier le Médecin</h1>

    <form action="{{ route('medecins.update', $medecin->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('medecins.form')

        <button type="submit" class="btn btn-warning">Mettre à jour</button>
        <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection


