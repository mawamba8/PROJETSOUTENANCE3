@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

  <!-- Titre principal avec centrage du texte -->
  <div class="flex items-center justify-between mb-4">
    <div class="text-center w-full">
      <h2 class="text-2xl font-extrabold text-emerald-700">Ordonnances</h2>
      <p class="text-gray-500 text-sm">Gérer vos ordonnances facilement</p>
    </div>
    @if(auth()->user()->isDoctor() || auth()->user()->isAdmin())
      <a href="{{ route('prescriptions.create') }}" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg shadow transition">Nouvelle ordonnance</a>
    @endif
  </div>

  <!-- Message flash -->
  @if (session('ok'))
    <div class="p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center gap-2 shadow mb-4">
      <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ session('ok') }}
    </div>
  @endif

  <!-- Tableau des ordonnances -->
  <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
        <tr>
          <th class="p-3">#</th>
          <th class="p-3">Titre</th>
          <th class="p-3">Patient</th>
          <th class="p-3">Médecin</th>
          <th class="p-3">Statut</th>
          <th class="p-3">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @forelse($prescriptions as $p)
        <tr class="hover:bg-gray-50 transition">
          <td class="p-3 font-medium text-gray-700">{{ $p->id }}</td>
          <td class="p-3">{{ $p->title }}</td>
          <td class="p-3">{{ $p->patient->name ?? '—' }}</td>
          <td class="p-3">{{ $p->doctor->name ?? '—' }}</td>
          <td class="p-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold
              @if($p->status==='draft') bg-yellow-100 text-yellow-700
              @elseif($p->status==='validated') bg-emerald-100 text-emerald-700
              @elseif($p->status==='cancelled') bg-red-100 text-red-700
              @else bg-gray-100 text-gray-700 @endif">
              {{ ucfirst($p->status) }}
            </span>
          </td>
          <td class="p-3">
            <a href="{{ route('prescriptions.show',$p->id) }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition">Voir</a>
          </td>
        </tr>
        @empty
        <tr>
          <td class="p-3 text-center text-gray-500" colspan="6">Aucune ordonnance.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="p-3">{{ $prescriptions->links() }}</div>
  </div>

</div>
@endsection
