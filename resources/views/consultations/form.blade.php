<div class="mb-3">
    <label for="patient_id" class="form-label">Patient</label>
    <select name="patient_id" id="patient_id" class="form-control" required>
        <option value="">-- Sélectionner un patient --</option>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ old('patient_id', $consultation->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
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
            <option value="{{ $medecin->id }}" {{ old('medecin_id', $consultation->medecin_id ?? '') == $medecin->id ? 'selected' : '' }}>
                {{ $medecin->nom }} ({{ $medecin->specialite }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="rendezvous_id" class="form-label">Rendez-vous</label>
    <select name="rendezvous_id" id="rendezvous_id" class="form-control" required>
        <option value="">-- Sélectionner un rendez-vous --</option>
        @foreach($rendezvous as $rdv)
            <option value="{{ $rdv->id }}" {{ old('rendezvous_id', $consultation->rendezvous_id ?? '') == $rdv->id ? 'selected' : '' }}>
                {{ $rdv->date }} à {{ $rdv->heure }} - Patient : {{ $rdv->patient->nom }}
            </option>
                @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="diagnostic" class="form-label">Diagnostic</label>
    <textarea name="diagnostic" id="diagnostic" class="form-control" rows="3" required>{{ old('diagnostic', $consultation->diagnostic ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="traitement" class="form-label">Traitement</label>
    <textarea name="traitement" id="traitement" class="form-control" rows="3" required>{{ old('traitement', $consultation->traitement ?? '') }}</textarea>
</div>
