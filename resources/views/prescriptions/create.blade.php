@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Nouvelle ordonnance</h2>

@if ($errors->any())
  <div class="p-3 mb-4 bg-red-50 text-red-700 rounded">{{ $errors->first() }}</div>
@endif

<form method="post" action="{{ route('prescriptions.store') }}" class="bg-white p-4 rounded-2xl shadow space-y-4">
  @csrf

  <div class="grid md:grid-cols-3 gap-4">
    <div>
      <label class="text-sm">Patient</label>
      <select name="patient_id" class="w-full border rounded-lg px-3 py-2" required>
        <option value="">—</option>
        @foreach($patients as $pt)
          <option value="{{ $pt->id }}">{{ $pt->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="md:col-span-2">
      <label class="text-sm">Titre</label>
      <input name="title" class="w-full border rounded-lg px-3 py-2" required>
    </div>
  </div>

  <div>
    <label class="text-sm">Notes (optionnel)</label>
    <textarea name="notes" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
  </div>

  <div>
    <div class="flex items-center justify-between mb-2">
      <h3 class="font-semibold">Médicaments</h3>
      <button type="button" id="addRow" class="px-3 py-1 rounded bg-emerald-500 text-white text-sm">Ajouter une ligne</button>
    </div>

    <div id="items" class="space-y-3">
      <!-- gabarit ligne -->
      <div class="grid md:grid-cols-5 gap-2 item-row">
        <input name="items[0][drug]" placeholder="Médicament" class="border rounded px-2 py-2" required>
        <input name="items[0][dosage]" placeholder="Dosage (ex: 500 mg)" class="border rounded px-2 py-2" required>
        <input name="items[0][frequency]" placeholder="Fréquence (ex: 3x/jour)" class="border rounded px-2 py-2" required>
        <input name="items[0][duration]" placeholder="Durée (ex: 7 jours)" class="border rounded px-2 py-2">
        <input name="items[0][quantity]" placeholder="Quantité (ex: 14)" class="border rounded px-2 py-2">
      </div>
    </div>
  </div>

  <div>
    <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Enregistrer</button>
  </div>
</form>

<script>
  const items = document.getElementById('items');
  const addRow = document.getElementById('addRow');
  let idx = 1;

  addRow.onclick = () => {
    const row = document.createElement('div');
    row.className = 'grid md:grid-cols-5 gap-2 item-row';
    row.innerHTML = `
      <input name="items[${idx}][drug]" placeholder="Médicament" class="border rounded px-2 py-2" required>
      <input name="items[${idx}][dosage]" placeholder="Dosage (ex: 500 mg)" class="border rounded px-2 py-2" required>
      <input name="items[${idx}][frequency]" placeholder="Fréquence (ex: 3x/jour)" class="border rounded px-2 py-2" required>
      <input name="items[${idx}][duration]" placeholder="Durée (ex: 7 jours)" class="border rounded px-2 py-2">
      <input name="items[${idx}][quantity]" placeholder="Quantité (ex: 14)" class="border rounded px-2 py-2">
    `;
    items.appendChild(row);
    idx++;
  };
</script>
@endsection
