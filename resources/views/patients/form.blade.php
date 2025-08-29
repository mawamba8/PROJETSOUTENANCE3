<form
action="{{ route('patients.update', $patient->id ) }}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
    <label>Nom</label>
    <input type="text" name="nom" class="form-control" value="{{ old('nom', $patient->nom ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Prénom</label>
    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $patient->prenom ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Date naissance</label>
    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $patient->date_naissance ?? '') }}">
</div>
<div class="mb-3">
    <label>E-mail</label>
    <input type="text" name="email" class="form-control" value="{{ old('email', $patient->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Téléphone</label>
    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $patient->telephone ?? '') }}">
</div>

<div class="mb-3">
    <label>Sexe</label>
    <input type="text" name="sexe" class="form-control" value="{{ old('sexe', $patient->sexe ?? '') }}">
</div>
<button class="btn btn-success">Enregistrer</button>
<a href="{{ route('patients.index') }}" class="btn btn-secondary">Annuler</a>

