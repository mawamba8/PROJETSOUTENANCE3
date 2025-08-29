<div class="mb-3">
    <label for="patient_id" class="form-label">Patient</label>
    <select name="patient_id" id="patient_id" class="form-control" required>
        <option value="">-- Sélectionner un patient --</option>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ old('patient_id', $rendezvous->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                {{ $patient->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="medecin_id" class="form-label">Médecin</label>
    <select name="medecin_id" id="medecin_id" class="form-control" required>
        <option value="">-- Sélectionner un médecin --</option>
        @foreach($medecins as $medecin)
            <option value="{{ $medecin->id }}" {{ old('medecin_id', $rendezvous->medecin_id ?? '') == $medecin->id ? 'selected' : '' }}>
                {{ $medecin->nom }} ({{ $medecin->specialite }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $rendezvous->date ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="heure" class="form-label">Heure</label>
    <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure', $rendezvous->heure ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="statut" class="form-label">Statut</label>
    <select name="statut" id="statut" class="form-control" required>
        <option value="En attente" {{ old('statut', $rendezvous->statut ?? '') == 'En attente' ? 'selected' : '' }}>En attente</option>
        <option value="Confirmé" {{ old('statut', $rendezvous->statut ?? '') == 'Confirmé' ? 'selected' : '' }}>Confirmé</option>
        <option value="Annulé" {{ old('statut', $rendezvous->statut ?? '') == 'Annulé' ? 'selected' : '' }}>Annulé</option>
    </select>
</div>
