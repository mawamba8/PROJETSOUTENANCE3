@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-warning">Modifier le Carnet Médical</h1>

    <form action="{{ route('carnetmedicals.update', $carnetmedical->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('carnetmedicals.form')
        <button type="submit" class="btn btn-warning">Mettre à jour</button>
        <a href="{{ route('carnetmedicals.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
