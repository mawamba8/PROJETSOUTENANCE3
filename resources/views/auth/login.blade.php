@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10 ">
  <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
    <!-- Titre -->
    <h2 class="text-3xl font-extrabold text-emerald-600 text-center mb-6">Connexion</h2>

    <!-- Message d'erreur -->
    @if($errors->any())
      <div class="p-3 mb-4 bg-red-50 text-red-700 rounded-lg flex items-center gap-2">
        <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{ $errors->first() }}
      </div>
    @endif

    <!-- Formulaire -->
    <form method="post" action="{{ route('login.submit') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" placeholder="exemple@mail.com"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 transition"/>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <input name="password" type="password" placeholder="••••••••"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 transition"/>
      </div>

      <button class="w-full py-3 bg-emerald-500 text-white font-semibold rounded-lg shadow hover:bg-emerald-600 transition">
        Se connecter
      </button>
    </form>

    <!-- Informations utilisateurs -->
    <p class="mt-6 text-xs text-gray-500 text-center">
      Admin: admin@cmn.local / password — Médecin: dr@cmn.local — Patient: patient@cmn.local
    </p>
  </div>
</div>
@endsection
