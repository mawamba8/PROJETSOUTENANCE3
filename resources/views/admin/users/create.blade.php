@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Créer un utilisateur</h2>

@if ($errors->any())
  <div class="p-3 mb-4 bg-red-50 text-red-700 rounded">{{ $errors->first() }}</div>
@endif

<form method="post" action="{{ route('admin.users.store') }}" class="bg-white p-6 rounded-2xl shadow space-y-4">
  @csrf

  <div class="grid md:grid-cols-3 gap-4">
    <div>
      <label class="text-sm">Nom</label>
      <input name="name" class="w-full border rounded-lg px-3 py-2" required>
    </div>
    <div>
      <label class="text-sm">Email</label>
      <input name="email" type="email" class="w-full border rounded-lg px-3 py-2" required>
    </div>
    <div>
      <label class="text-sm">Mot de passe</label>
      <input name="password" type="password" class="w-full border rounded-lg px-3 py-2" required>
    </div>
  </div>

  <div>
    <label class="text-sm">Rôle</label>
    <select name="role" id="role" class="w-full border rounded-lg px-3 py-2">
      <option value="patient">Patient</option>
      <option value="doctor">Médecin</option>
      <option value="admin">Admin</option>
    </select>
  </div>

  {{-- Bloc Médecin --}}
  <div id="blocDoctor" class="hidden border rounded-xl p-4">
    <div class="grid md:grid-cols-3 gap-4">
      <div>
        <label class="text-sm">Département</label>
        <select name="department_id" class="w-full border rounded-lg px-3 py-2">
          @foreach($departments as $d)
            <option value="{{ $d->id }}">{{ $d->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="text-sm">Spécialité</label>
        <select name="specialty_id" class="w-full border rounded-lg px-3 py-2">
          @foreach($specialties as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="text-sm">Téléphone</label>
        <input name="phone" class="w-full border rounded-lg px-3 py-2">
      </div>
    </div>
  </div>

  {{-- Bloc Patient --}}
  <div id="blocPatient" class="border rounded-xl p-4">
    <div class="grid md:grid-cols-3 gap-4">
      <div>
        <label class="text-sm">Date de naissance</label>
        <input name="birthdate" type="date" class="w-full border rounded-lg px-3 py-2">
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
        <label class="text-sm">Groupe sanguin</label>
        <input name="blood_group" class="w-full border rounded-lg px-3 py-2" placeholder="O+, A-, ...">
      </div>
    </div>
    <div class="grid md:grid-cols-3 gap-4 mt-3">
      <div>
        <label class="text-sm">Adresse</label>
        <input name="address" class="w-full border rounded-lg px-3 py-2">
      </div>
      <div>
        <label class="text-sm">Allergies</label>
        <input name="allergies" class="w-full border rounded-lg px-3 py-2">
      </div>
      <div>
        <label class="text-sm">Assuré ?</label>
        <select name="insured" class="w-full border rounded-lg px-3 py-2">
          <option value="0">Non</option>
          <option value="1">Oui</option>
        </select>
      </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mt-3">
      <div>
        <label class="text-sm">Assureur</label>
        <input name="insurer_name" class="w-full border rounded-lg px-3 py-2">
      </div>
      <div>
        <label class="text-sm">N° Police</label>
        <input name="policy_number" class="w-full border rounded-lg px-3 py-2">
      </div>
    </div>
  </div>

  <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Créer</button>
</form>

<script>
  const roleSel = document.getElementById('role');
  const blocDoctor = document.getElementById('blocDoctor');
  const blocPatient = document.getElementById('blocPatient');
  function updateRoleBlocks(){
    const r = roleSel.value;
    blocDoctor.classList.toggle('hidden', r!=='doctor');
    blocPatient.classList.toggle('hidden', r!=='patient');
  }
  roleSel.addEventListener('change', updateRoleBlocks);
  updateRoleBlocks();
</script>
@endsection
