@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Mon Profil</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('patient.profil.update') }}" method="POST" class="bg-white p-6 rounded-xl shadow">
        @csrf
        <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" value="{{ $user->date_naissance }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" value="{{ $user->telephone }}" class="form-control">
        </div>
  <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
