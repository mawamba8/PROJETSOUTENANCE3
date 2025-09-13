@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">Transferts</h2>

@if (session('ok'))
  <div class="p-3 mb-4 bg-emerald-50 text-emerald-700 rounded">{{ session('ok') }}</div>
@endif

{{-- Création d’une demande de transfert --}}
<form method="post" action="{{ route('transfers.store') }}" class="bg-white p-4 rounded-2xl shadow mb-6 grid md:grid-cols-5 gap-3">
  @csrf

  {{-- Patient par NOM --}}
  <div class="md:col-span-2">
    <label class="text-sm">Patient</label>
    <select name="patient_id" class="w-full border rounded-lg px-3 py-2" required>
      <option value="">— Sélectionner —</option>
      @isset($patients)
        @foreach($patients as $p)
          <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
      @endisset
    </select>
  </div>

  <div>
    <label class="text-sm">Vers spécialité</label>
    <select name="to_specialty_id" class="w-full border rounded-lg px-3 py-2" required>
      @foreach($specialties as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="text-sm">Urgence</label>
    <select name="urgency" class="w-full border rounded-lg px-3 py-2">
      <option value="low">Faible</option>
      <option value="normal" selected>Normale</option>
      <option value="high">Élevée</option>
      <option value="critical">Critique</option>
    </select>
  </div>

  <div class="md:col-span-5">
    <label class="text-sm">Raison (optionnel)</label>
    <textarea name="reason" class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Motif du transfert (ex: avis spécialisé, imagerie, chirurgie...)"></textarea>
  </div>

  <div class="md:col-span-5">
    <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Créer</button>
  </div>
</form>

{{-- Liste des transferts --}}
<div class="bg-white rounded-2xl shadow overflow-x-auto">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-gray-50">
        <th class="p-2 text-left">#</th>
        <th class="p-2 text-left">Patient</th>
        <th class="p-2 text-left">Vers Spécialité</th>
        <th class="p-2 text-left">Urgence</th>
        <th class="p-2 text-left">Statut</th>
        <th class="p-2 text-left">Attribué</th>
      </tr>
    </thead>
    <tbody>
      @forelse($transfers as $t)
      <tr class="border-t">
        <td class="p-2">{{ $t->id }}</td>
        <td class="p-2">{{ $t->patient->name ?? '—' }}</td>
        <td class="p-2">{{ $t->toSpecialty->name ?? '—' }}</td>
        <td class="p-2">{{ $t->urgency }}</td>
        <td class="p-2">{{ $t->status }}</td>
        <td class="p-2">{{ $t->assignedDoctor->name ?? '-' }}</td>
      </tr>
      @empty
      <tr><td class="p-2" colspan="6">Aucune demande.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Pagination si nécessaire --}}
@if(method_exists($transfers, 'links'))
  <div class="mt-3">{{ $transfers->links() }}</div>
@endif
@endsection
