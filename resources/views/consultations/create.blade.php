@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-success">Nouvelle Consultation</h1>

    <form action="{{ route('consultations.store') }}" method="POST">
        @csrf
        @include('consultations.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
