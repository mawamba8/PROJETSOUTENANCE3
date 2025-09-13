@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center items-center text-center">
    <h1 class="text-4xl font-extrabold text-emerald-600 mb-6">Bienvenue sur le Carnet Médical</h1>
    <p class="text-gray-600 mb-8">Votre plateforme de suivi médical numérique</p>

    <!-- Bouton Connexion -->
    <a href="{{ route('welcome.page') }}" 
       class="px-6 py-3 bg-emerald-500 text-white font-semibold rounded-lg shadow hover:bg-emerald-600 transition">
       Connexion
    </a>
</div>
@endsection