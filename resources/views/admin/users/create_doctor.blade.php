@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Créer un médecin</h2>
@if ($errors->any())
  <div class="p-3 mb-4 bg-red-50 text-red-700 rounded">{{ $errors->first() }}</div>
@endif
<form method="post" action="{{ route('users.store.doctor') }}" class="bg-white p-6 rounded-2xl shadow grid md:grid-cols-2 gap-4">
  @csrf
  <div>
    <label class="text-sm">Nom</label>
    <input name="name" class="w-full border rounded-lg px-3 py-2" required>
  </div>
  <div>
    <label class="text-sm">Email</label>
    <input name="email" type="email" class="w-full border rounded-lg px-3 py-2" required>
  </div>
  <div>
    <label class="text-sm">Mot de passe (optionnel)</label>
    <input name="password" type="password" class="w-full border rounded-lg px-3 py-2">
  </div>

  <div>
    <label class="text-sm">Département</label>
    <select name="department_id" class="w-full border rounded-lg px-3 py-2" required>
      <option value="">—</option>
      @foreach($departments as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="text-sm">Spécialité</label>
    <select name="specialty_id" class="w-full border rounded-lg px-3 py-2" required>
      <option value="">—</option>
      @foreach($specialties as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="text-sm">Téléphone</label>
    <input name="phone" class="w-full border rounded-lg px-3 py-2">
  </div>

  <div class="md:col-span-2">
    <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Créer</button>
  </div>
</form>
@endsection
