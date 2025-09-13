@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

  <!-- Titre principal -->
  <div class="text-center mb-8">
    <h2 class="text-3xl font-extrabold text-emerald-700 flex items-center justify-center gap-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-6 4h2m-7 4h12M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
      </svg>
      Gestion des Rendez-vous
    </h2>
    <p class="text-gray-500 mt-2">Planifiez et gérez vos rendez-vous facilement</p>
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

    <!-- Formulaire de rendez-vous -->
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      @if($u->isPatient())
        <h3 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">📅 Demander un rendez-vous</h3>
        <form method="post" action="{{ route('appointments.store') }}" class="space-y-6">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Médecin</label>
            <select name="doctor_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
              @foreach($doctors as $d)
                <option value="{{ $d->id }}">{{ $d->name }} — {{ $d->doctorProfile?->specialty?->name ?? '—' }}</option>
              @endforeach
            </select>
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-2">Date & heure</label>
              <input type="datetime-local" name="scheduled_at" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-2">Urgence</label>
              <select name="urgency" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                <option value="low">Basse</option>
                <option value="normal" selected>Normale</option>
                <option value="high">Élevée</option>
                <option value="critical">Critique</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Notes</label>
            <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
          </div>

          <button class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow transition">Envoyer</button>
        </form>
      @endif

      @if($u->isDoctor())
        <h3 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">👨‍⚕️ Programmer un patient</h3>
        <form method="post" action="{{ route('appointments.store') }}" class="space-y-6">
          @csrf
          <input type="hidden" name="doctor_id" value="{{ $u->id }}">
          <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Patient</label>
            <select name="patient_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
              @foreach($patients as $p)
                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
              @endforeach
            </select>
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-2">Date & heure</label>
              <input type="datetime-local" name="scheduled_at" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-2">Urgence</label>
              <select name="urgency" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                <option value="low">Basse</option>
                <option value="normal" selected>Normale</option>
                <option value="high">Élevée</option>
                <option value="critical">Critique</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Notes</label>
            <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
          </div>

          <button class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow transition">Programmer</button>
        </form>
      @endif
    </div>

    <!-- Liste des rendez-vous -->
    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
      <h3 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">📋 Liste des rendez-vous</h3>
      <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left border-collapse">
          <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
            <tr>
              <th class="p-3">Date</th>
              <th class="p-3">Patient</th>
              <th class="p-3">Médecin</th>
              <th class="p-3">Urgence</th>
              <th class="p-3">Statut</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($list as $a)
              <tr class="hover:bg-gray-50">
                <td class="p-3">{{ \Illuminate\Support\Carbon::parse($a->scheduled_at)->format('d/m/Y H:i') }}</td>
                <td class="p-3">{{ $a->patient->name ?? $a->patient_id }}</td>
                <td class="p-3">{{ $a->doctor->name ?? $a->doctor_id }}</td>
                <td class="p-3">
                  <span class="px-2 py-1 rounded-full text-xs font-semibold
                    @if($a->urgency=='critical') bg-red-100 text-red-700
                    @elseif($a->urgency=='high') bg-orange-100 text-orange-700
                    @elseif($a->urgency=='normal') bg-emerald-100 text-emerald-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst($a->urgency) }}
                  </span>
                </td>
                <td class="p-3">
                  {{ ucfirst($a->status) }}
                  @if($a->is_mandatory) 
                    <span class="text-xs text-emerald-600">(obligatoire)</span>
                  @endif
                </td>
                <td class="p-3 flex flex-wrap gap-2">
                  @if(auth()->user()->isDoctor() && $a->doctor_id===auth()->id() && $a->status!=='done')
                    <form method="post" action="{{ route('appointments.update',$a->id) }}">
                      @csrf @method('PUT')
                      <input type="hidden" name="action" value="confirm">
                      <button class="text-emerald-600 hover:underline">Confirmer</button>
                    </form>
                    <form method="post" action="{{ route('appointments.update',$a->id) }}">
                      @csrf @method('PUT')
                      <input type="hidden" name="action" value="cancel">
                      <button class="text-red-600 hover:underline">Annuler</button>
                    </form>
                  @endif
                  @if(auth()->id()===$a->created_by && $a->status!=='done')
                    <form method="post" action="{{ route('appointments.destroy',$a->id) }}" onsubmit="return confirm('Supprimer ?')">
                      @csrf @method('DELETE')
                      <button class="text-gray-600 hover:underline">Supprimer</button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="p-3 text-center text-gray-500">Aucun rendez-vous.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-6">{{ $list->links() }}</div>
    </div>

  </div>
</div>
@endsection
