@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Liste des patients</h2>
        <a href="{{ route('medecin.create.patient') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Ajouter un patient
        </a>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->telephone ?? '-' }}</td>
                                <td>{{ $patient->adresse ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('medecin.patient.show', $patient->id) }}" class="btn btn-info btn-sm mb-1">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                    <a href="{{ route('medecin.patient.edit', $patient->id) }}" class="btn btn-warning btn-sm mb-1">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <form action="{{ route('medecin.patient.destroy', $patient->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm mb-1" onclick="return confirm('Voulez-vous vraiment supprimer ce patient ?')">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun patient enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
