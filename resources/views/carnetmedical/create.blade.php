@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-success">Nouveau Carnet Médical</h1>

    <form action="{{ route('carnetmedicals.store') }}" method="POST">
        @csrf
        @include('carnetmedicals.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('carnetmedicals.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection


