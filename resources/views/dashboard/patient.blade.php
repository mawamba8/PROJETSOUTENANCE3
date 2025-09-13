@extends('layouts.app')
@section('content')

<div class="mb-10 text-center">
  <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Mon Carnet Médical</h2>
  <p class="text-gray-500 text-sm mt-2">Accédez facilement à vos informations médicales et services.</p>
</div>

{{-- Grille principale --}}
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

  {{-- Prendre rendez-vous --}}
  <a href="{{ route('appointments.index') }}" 
     class="group p-6 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl shadow hover:shadow-xl transition-all flex flex-col justify-between">
    <div class="flex items-center justify-between mb-6">
      <span class="text-emerald-700 font-bold text-lg">Prendre rendez-vous</span>
      <div class="p-3 bg-emerald-200 rounded-xl group-hover:bg-emerald-300 transition">
        <i class="fa-solid fa-calendar-plus text-emerald-700 text-xl"></i>
      </div>
    </div>
    <p class="text-sm text-gray-600">Choisir un médecin / créneau</p>
  </a>

  {{-- Ordonnances --}}
  <a href="{{ route('prescriptions.index') }}" 
     class="group p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl shadow hover:shadow-xl transition-all flex flex-col justify-between">
    <div class="flex items-center justify-between mb-6">
      <span class="text-indigo-700 font-bold text-lg">Mes ordonnances</span>
      <div class="p-3 bg-indigo-200 rounded-xl group-hover:bg-indigo-300 transition">
        <i class="fa-solid fa-file-prescription text-indigo-700 text-xl"></i>
      </div>
    </div>
    <p class="text-sm text-gray-600">Lister / télécharger en PDF</p>
  </a>

  {{-- Factures --}}
  <a href="{{ route('billing.index') }}" 
     class="group p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl shadow hover:shadow-xl transition-all flex flex-col justify-between">
    <div class="flex items-center justify-between mb-6">
      <span class="text-yellow-700 font-bold text-lg">Mes factures</span>
      <div class="p-3 bg-yellow-200 rounded-xl group-hover:bg-yellow-300 transition">
        <i class="fa-solid fa-file-invoice-dollar text-yellow-700 text-xl"></i>
      </div>
    </div>
    <p class="text-sm text-gray-600">Paiement & assurance</p>
  </a>

  {{-- Assurance --}}
  <a href="{{ route('insurance.index') }}" 
     class="group p-6 bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl shadow hover:shadow-xl transition-all flex flex-col justify-between">
    <div class="flex items-center justify-between mb-6">
      <span class="text-pink-700 font-bold text-lg">Assurance</span>
      <div class="p-3 bg-pink-200 rounded-xl group-hover:bg-pink-300 transition">
        <i class="fa-solid fa-shield-heart text-pink-700 text-xl"></i>
      </div>
    </div>
    <p class="text-sm text-gray-600">Suivre mes demandes</p>
  </a>

  {{-- Pharmacies --}}
  <a href="{{ route('pharmacies.map') }}" 
     class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl shadow hover:shadow-xl transition-all flex flex-col justify-between">
    <div class="flex items-center justify-between mb-6">
      <span class="text-purple-700 font-bold text-lg">Pharmacies proches</span>
      <div class="p-3 bg-purple-200 rounded-xl group-hover:bg-purple-300 transition">
        <i class="fa-solid fa-map-location-dot text-purple-700 text-xl"></i>
      </div>
    </div>
    <p class="text-sm text-gray-600">Carte & géolocalisation</p>
  </a>

</div>
@endsection
