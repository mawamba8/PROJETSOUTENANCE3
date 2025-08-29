@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1 class="mb-4 text-warning">Modifier le patient</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('patients.form')

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection