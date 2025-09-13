@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Créer un patient</h2>
@if ($errors->any())
  <div class="p-3 mb-4 bg-red-50 text-red-700 rounded">{{ $errors->first() }}</div>
@endif
<form method="post" action="{{ route('users.store.patient') }}" class="bg-white p-6 rounded-2xl shadow grid md:grid-cols-2 gap-4">
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
    <label class="text-sm">Sexe</label>
    <select name="sex" class="w-full border rounded-lg px-3 py-2">
      <option value="">—</option>
      <option value="M">Masculin</option>
      <option value="F">Féminin</option>
    </select>
  </div>
  <div>
    <label class="text-sm">Date de naissance</label>
    <input name="birthdate" type="date" class="w-full border rounded-lg px-3 py-2">
  </div>
  <div class="md:col-span-2">
    <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Créer</button>
  </div>
</form>
@endsection
