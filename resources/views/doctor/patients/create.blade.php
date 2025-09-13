@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-10">

  <!-- Titre -->
  <div class="text-center mb-8">
    <h2 class="text-2xl font-extrabold text-emerald-700">Créer un patient (Médecin)</h2>
    <p class="text-gray-500 mt-1 text-sm">Remplissez le formulaire pour ajouter un nouveau patient</p>
  </div>

  <!-- Message d'erreur -->
  @if ($errors->any())
    <div class="p-4 mb-6 bg-red-50 text-red-700 border border-red-200 rounded-lg shadow flex items-center gap-2">
      <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
      {{ $errors->first() }}
    </div>
  @endif

  <!-- Formulaire -->
  <form method="post" action="{{ route('doctor.patients.store') }}" class="bg-white p-8 rounded-2xl shadow-lg space-y-6">
    @csrf

    <!-- Nom -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-1">Nom complet</label>
      <input name="name" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Nom et prénom" required>
    </div>

    <!-- Date de naissance -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-1">Date de naissance</label>
      <input name="birthdate" type="date" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <!-- Email -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
      <input name="email" type="email" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="exemple@domaine.com" required>
    </div>

    <!-- Sexe -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-1">Sexe</label>
      <select name="sex" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
        <option value="">— Sélectionner —</option>
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
      </select>
    </div>

    <!-- Mot de passe -->
    <div>
      <label class="block text-sm font-medium text-gray-600 mb-1">Mot de passe (optionnel)</label>
      <input name="password" type="password" class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="••••••">
    </div>

    <!-- Bouton -->
    <div>
      <button type="submit" class="w-full px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow transition">Créer le patient</button>
    </div>
  </form>
</div>
@endsection
