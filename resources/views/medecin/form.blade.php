<div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $medecin->nom ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="prenom" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="prrenom" name="prenom" value="{{ old('prenom', $medecin->prenom ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="specialite" class="form-label">Spécialité</label>
    <input type="text" class="form-control" id="specialite" name="specialite" value="{{ old('specialite', $medecin->specialite ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $medecin->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telephone" class="form-label">Téléphone</label>
    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $medecin->telephone ?? '') }}" required>
</div>
