@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

  <!-- Titre principal -->
  <div class="text-center mb-8">
    <h2 class="text-3xl font-extrabold text-emerald-700 flex items-center justify-center gap-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2 4 4M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
      </svg>
      Gestion Assurance
    </h2>
    <p class="text-gray-500 mt-2">Soumettez et suivez vos demandes facilement</p>
  </div>

  <!-- Message flash -->
  @if(session('ok'))
    <div class="max-w-xl mx-auto p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center gap-2 shadow">
      <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ session('ok') }}
    </div>
  @endif

  <!-- Grille principale -->
  <div class="grid lg:grid-cols-2 gap-10">

    <!-- Formulaire Nouvelle demande -->
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <h3 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">📝 Nouvelle demande</h3>
      <form method="post" action="{{ route('insurance.claim') }}" class="space-y-6">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Ma facture</label>
          <select name="invoice_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            @foreach($invoices as $inv)
              <option value="{{ $inv->id }}">#{{ $inv->id }} — {{ $inv->label }} ({{ number_format($inv->amount,0,',',' ') }} FCFA)</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Assureur</label>
          <select name="insurance_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            @foreach($insurers as $ins)
              <option value="{{ $ins->id }}">{{ $ins->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center gap-4">
          <button class="py-3 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow transition">Envoyer</button>
          <a href="{{ route('insurance.markTimeouts') }}" class="text-sm text-gray-500 underline hover:text-gray-700">[Tester SLA : marquer les retards]</a>
        </div>
      </form>
    </div>

    <!-- Tableau Mes demandes -->
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <h3 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">📋 Mes demandes</h3>
      <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left border-collapse">
          <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
            <tr>
              <th class="p-3">ID</th>
              <th class="p-3">Facture</th>
              <th class="p-3">Assureur</th>
              <th class="p-3">Échéance</th>
              <th class="p-3">Statut</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($claims as $c)
              <tr class="hover:bg-gray-50">
                <td class="p-3 font-medium text-gray-700">#{{ $c->id }}</td>
                <td class="p-3">{{ $c->invoice->label ?? '-' }}</td>
                <td class="p-3">{{ $c->insurance->name ?? '-' }}</td>
                <td class="p-3">{{ $c->response_due_at?->format('d/m/Y H:i') ?? '-' }}</td>
                <td class="p-3">
                  <span class="px-2 py-1 rounded-full text-xs font-semibold
                    @if($c->status=='pending') bg-yellow-100 text-yellow-700
                    @elseif($c->status=='approved') bg-emerald-100 text-emerald-700
                    @elseif($c->status=='rejected') bg-red-100 text-red-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst($c->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="p-3 text-center text-gray-500">Aucune demande.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection
