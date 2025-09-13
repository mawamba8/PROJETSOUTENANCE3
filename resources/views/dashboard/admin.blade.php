@extends('layouts.app') 
@section('content')

<div class="mb-8">
  <h2 class="text-2xl font-bold text-gray-800"> Tableau de bord — Administrateur</h2>
  <p class="text-gray-500 text-sm">Vue d’ensemble de vos activités et statistiques</p>
</div>

{{-- Statistiques principales --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">
  <a href="{{ route('users.create.doctor') }}" 
     class="p-6 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl shadow hover:shadow-lg transition block">
      <div class="flex items-center justify-between mb-2">
        <span class="text-emerald-600 font-bold">Créer un médecin</span>
        <i class="fa-solid fa-user-doctor text-emerald-500 text-xl"></i>
      </div>
      <p class="text-sm text-gray-600">Département & spécialité</p>
  </a>

  <a href="{{ route('users.create.patient') }}" 
     class="p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow hover:shadow-lg transition block">
      <div class="flex items-center justify-between mb-2">
        <span class="text-blue-600 font-bold">Créer un patient</span>
        <i class="fa-solid fa-hospital-user text-blue-500 text-xl"></i>
      </div>
      <p class="text-sm text-gray-600">Infos de base</p>
  </a>

  <a href="{{ route('appointments.index') }}" 
     class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition block">
      <div class="text-sm text-gray-500">RDV aujourd’hui</div>
      <div class="text-3xl font-extrabold text-emerald-600">{{ $rdvToday }}</div>
  </a>

  <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-sm text-gray-500">Patients</div>
      <div class="text-3xl font-extrabold text-blue-600">{{ $totalPatients }}</div>
  </div>

  <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-sm text-gray-500">Médecins</div>
      <div class="text-3xl font-extrabold text-indigo-600">{{ $totalDoctors }}</div>
  </div>
</div>

{{-- Graphiques et revenus --}}
<div class="grid md:grid-cols-2 gap-6">
  <div class="p-6 bg-gradient-to-br from-emerald-50 to-white rounded-2xl shadow hover:shadow-lg transition">
      <div class="text-sm text-gray-500">Revenus du jour</div>
      <div class="text-3xl font-extrabold text-emerald-700">
          {{ number_format($revenusJour,0,',',' ') }} FCFA
      </div>
  </div>

  <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
      <canvas id="revChart" height="120"></canvas>
  </div>
</div>

{{-- Script Chart.js --}}
<script>
const ctx = document.getElementById('revChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: @json($chartLabels),
    datasets: [{
      label: 'Revenus (FCFA)',
      data: @json($chartData),
      backgroundColor: 'rgba(16, 185, 129, 0.6)',
      borderColor: 'rgba(5, 150, 105, 1)',
      borderWidth: 1,
      borderRadius: 6,
    }]
  },
  options: {
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
@endsection
