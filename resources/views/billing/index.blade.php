@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

  <!-- Titre principal -->
  <div class="text-center mb-8">
    <h2 class="text-3xl font-extrabold text-emerald-700 flex items-center justify-center gap-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3 0-5 3-5 5s2 5 5 5 5-2 5-5-2-5-5-5z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3"/>
      </svg>
      Facturation
    </h2>
    <p class="text-gray-500 mt-2">Créer et suivre les factures des patients</p>
  </div>

  <!-- Message flash -->
  @if (session('ok'))
    <div class="max-w-xl mx-auto p-4 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center gap-2 shadow">
      <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ session('ok') }}
    </div>
  @endif

  <!-- Formulaire création facture (Admin / Médecin) -->
  @auth
  @if(auth()->user()->role !== 'patient')
    <form method="post" action="{{ route('billing.store') }}" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition grid md:grid-cols-5 gap-4">
      @csrf

      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-600 mb-1">Patient</label>
        <select name="patient_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
          <option value="">— Sélectionner —</option>
          @isset($patients)
            @foreach($patients as $p)
              <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
          @endisset
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Département</label>
        <select name="department_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
          <option value="">—</option>
          @foreach($departments as $d)
            <option value="{{ $d->id }}">{{ $d->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Ordonnance liée (optionnel)</label>
        <select name="service_prescription_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
          <option value="">—</option>
          @foreach($myPrescriptions as $pr)
            <option value="{{ $pr->id }}">#{{ $pr->id }} — {{ $pr->title }}</option>
          @endforeach
        </select>
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-600 mb-1">Libellé</label>
        <input name="label" placeholder="Ex: Consultation / ECG / Analyses..." class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Montant</label>
        <input name="amount" placeholder="0" type="number" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2" required>
      </div>

      <div class="md:col-span-5">
        <button class="px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow transition">Créer</button>
      </div>
    </form>
  @endif
  @endauth

  <!-- Tableau des factures -->
  <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
        <tr>
          <th class="p-3">#</th>
          <th class="p-3">Patient</th>
          <th class="p-3">Département</th>
          <th class="p-3">Libellé</th>
          <th class="p-3">Montant</th>
          <th class="p-3">Statut</th>
          @if(auth()->user()->isAdmin() || auth()->user()->isDoctor())
          <th class="p-3">Action</th>
          @endif
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @forelse ($invoices as $i)
        <tr class="hover:bg-gray-50">
          <td class="p-3 font-medium text-gray-700">{{ $i->id }}</td>
          <td class="p-3">{{ $i->patient->name ?? '—' }}</td>
          <td class="p-3">{{ $i->department->name ?? '—' }}</td>
          <td class="p-3">{{ $i->label }}</td>
          <td class="p-3">{{ number_format($i->amount,0,',',' ') }} FCFA</td>
          <td class="p-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold
              @if($i->status==='draft') bg-yellow-100 text-yellow-700
              @elseif($i->status==='paid') bg-emerald-100 text-emerald-700
              @elseif($i->status==='cancelled') bg-red-100 text-red-700
              @else bg-gray-100 text-gray-700 @endif">
              {{ ucfirst($i->status) }}
            </span>
          </td>

          @if(auth()->user()->isAdmin() || auth()->user()->isDoctor())
          <td class="p-3">
            <form method="post" action="{{ route('billing.updateStatus', $i->id) }}" class="flex items-center gap-2">
              @csrf @method('PATCH')
              <select name="status" class="border rounded px-2 py-1 text-sm">
                <option value="draft" {{ $i->status==='draft'?'selected':'' }}>draft</option>
                <option value="paid" {{ $i->status==='paid'?'selected':'' }}>paid</option>
                <option value="cancelled" {{ $i->status==='cancelled'?'selected':'' }}>cancelled</option>
              </select>
              <button class="px-2 py-1 bg-emerald-500 hover:bg-emerald-600 text-white rounded text-sm">OK</button>
            </form>
          </td>
          @endif
        </tr>
        @empty
        <tr><td class="p-3 text-center text-gray-500" colspan="7">Aucune facture.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div class="p-3">{{ $invoices->links() }}</div>
  </div>

</div>
@endsection
