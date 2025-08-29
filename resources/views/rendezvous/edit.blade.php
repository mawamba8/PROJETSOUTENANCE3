@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-warning">Modifier le Rendez-vous</h1>

    <form action="{{ route('rendezvous.update', $rendezvous->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('rendezvous.form')
        <button type="submit" class="btn btn-warning">Mettre à jour</button>
        <a href="{{ route('rendezvous.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
