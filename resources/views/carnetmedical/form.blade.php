<div class="mb-3">
    <label for="patient_id" class="form-label">Patient</label>
    <select name="patient_id" id="patient_id" class="form-control" required>
        <option value="">-- Sélectionner un patient --</option>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ old('patient_id', $carnetmedical->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                {{ $patient->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="antecedents" class="form-label">Antécédents</label>
    <textarea name="antecedents" id="antecedents" class="form-control" rows="3">{{ old('antecedents', $carnetmedical->antecedents ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="allergies" class="form-label">Allergies</label>
    <textarea name="allergies" id="allergies" class="form-control" rows="3">{{ old('allergies', $carnetmedical->allergies ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notes</label>
    <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $carnetmedical->notes ?? '') }}</textarea>
</div>
