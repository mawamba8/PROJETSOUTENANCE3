@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-warning">Modifier la Consultation</h1>

    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('consultations.form')
        <button type="submit" class="btn btn-warning">Mettre à jour</button>
        <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
