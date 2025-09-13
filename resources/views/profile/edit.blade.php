@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Mon profil</h2>

@if(session('ok'))
  <div class="p-3 mb-4 bg-emerald-50 text-emerald-700 rounded">{{ session('ok') }}</div>
@endif

<form method="post" action="{{ route('profile.update') }}" class="bg-white p-4 rounded-2xl shadow space-y-3">
  @csrf
  <div class="grid md:grid-cols-3 gap-3">
    <div>
      <label class="text-sm">Nom</label>
      <input name="name" class="w-full border rounded-lg px-3 py-2" value="{{ old('name',$u->name) }}">
    </div>
    <div>
      <label class="text-sm">Email</label>
      <input name="email" type="email" class="w-full border rounded-lg px-3 py-2" value="{{ old('email',$u->email) }}">
    </div>
    <div>
      <label class="text-sm">Bio</label>
      <input name="bio" class="w-full border rounded-lg px-3 py-2" value="{{ old('bio',$u->bio) }}">
    </div>
  </div>

  <div class="grid md:grid-cols-3 gap-3">
    <div>
      <label class="text-sm">Nouveau mot de passe</label>
      <input name="password" type="password" class="w-full border rounded-lg px-3 py-2">
    </div>
    <div>
      <label class="text-sm">Confirmer</label>
      <input name="password_confirmation" type="password" class="w-full border rounded-lg px-3 py-2">
    </div>
  </div>

  @if($u->isDoctor())
  <hr class="my-3">
  <div class="text-sm font-semibold">Informations Médecin</div>
  <div class="grid md:grid-cols-4 gap-3">
    <div>
      <label class="text-sm">Département</label>
      <select name="department_id" class="w-full border rounded-lg px-3 py-2">
        <option value="">—</option>
        @foreach($departments as $d)
          <option value="{{ $d->id }}" @selected(old('department_id',$doctor->department_id ?? null)==$d->id)>{{ $d->name }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="text-sm">Spécialité</label>
      <select name="specialty_id" class="w-full border rounded-lg px-3 py-2">
        <option value="">—</option>
        @foreach($specialties as $s)
          <option value="{{ $s->id }}" @selected(old('specialty_id',$doctor->specialty_id ?? null)==$s->id)>{{ $s->name }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="text-sm">Téléphone</label>
      <input name="phone" class="w-full border rounded-lg px-3 py-2" value="{{ old('phone',$doctor->phone ?? '') }}">
    </div>
    <div>
      <label class="text-sm">À propos</label>
      <input name="about" class="w-full border rounded-lg px-3 py-2" value="{{ old('about',$doctor->about ?? '') }}">
    </div>
  </div>
  @endif

  @if($u->isPatient())
  <hr class="my-3">
  <div class="text-sm font-semibold">Informations Patient</div>
  <div class="grid md:grid-cols-4 gap-3">
    <div>
      <label class="text-sm">Naissance</label>
      <input name="birthdate" type="date" class="w-full border rounded-lg px-3 py-2" value="{{ old('birthdate',$patient->birthdate ?? '') }}">
    </div>
    <div>
      <label class="text-sm">Sexe</label>
      <select name="sex" class="w-full border rounded-lg px-3 py-2">
        <option value="">—</option>
        <option value="M" @selected(old('sex',$patient->sex ?? '')==='M')>Homme</option>
        <option value="F" @selected(old('sex',$patient->sex ?? '')==='F')>Femme</option>
      </select>
    </div>
    <div>
      <label class="text-sm">Adresse</label>
      <input name="address" class="w-full border rounded-lg px-3 py-2" value="{{ old('address',$patient->address ?? '') }}">
    </div>
    <div>
      <label class="text-sm">Groupe sanguin</label>
      <input name="blood_group" class="w-full border rounded-lg px-3 py-2" value="{{ old('blood_group',$patient->blood_group ?? '') }}">
    </div>
    <div>
      <label class="text-sm">Allergies</label>
      <input name="allergies" class="w-full border rounded-lg px-3 py-2" value="{{ old('allergies',$patient->allergies ?? '') }}">
    </div>
    <div>
      <label class="text-sm">Assuré ?</label>
      <select name="insured" class="w-full border rounded-lg px-3 py-2">
        <option value="0" @selected(!($patient->insured ?? false))>Non</option>
        <option value="1" @selected(($patient->insured ?? false))>Oui</option>
      </select>
    </div>
    <div>
      <label class="text-sm">Assureur</label>
      <input name="insurer_name" class="w-full border rounded-lg px-3 py-2" value="{{ old('insurer_name',$patient->insurer_name ?? '') }}">
    </div>
    <div>
      <label class="text-sm">N° police</label>
      <input name="policy_number" class="w-full border rounded-lg px-3 py-2" value="{{ old('policy_number',$patient->policy_number ?? '') }}">
    </div>
  </div>
  @endif

  <div class="mt-3">
    <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Enregistrer</button>
  </div>
</form>
@endsection
