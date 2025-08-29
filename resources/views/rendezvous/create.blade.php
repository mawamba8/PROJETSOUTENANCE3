@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-success">Nouveau Rendezvous</h1>

    <form action="{{ route('rendezvous.store') }}" method="POST">
        @csrf
        @include('rendezvous.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('rendezvous.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection