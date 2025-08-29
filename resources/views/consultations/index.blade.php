@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Liste des Consultations</h1>

    <a href="{{ route('consultations.create') }}" class="btn btn-success mb-3">➕ Nouvelle consultation</a>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Médecin</th>
                <th>Rendez-vous</th>
                <th>Diagnostic</th>
                <th>Traitement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->id }}</td>
                    <td>{{ $consultation->patient->nom }}</td>
                    <td>{{ $consultation->medecin->nom }}</td>
                    <td>{{ $consultation->rendezvous->date }} à {{ $consultation->rendezvous->heure }}</td>
                    <td>{{ $consultation->diagnostic }}</td>
                    <td>{{ $consultation->traitement }}</td>
                    <td>
                        <a href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-info btn-sm">👁 Voir</a>
                         <a href="{{ route('consultations.edit', $consultation->id) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                        <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette consultation ?')">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Aucune consultation trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
