@extends('layouts.app')

    @section('content')
    <div class="container">
    <h1 class="mb-4 text-primary">Liste des Rendez-vous</h1>

    <a href="{{ route('rendezvous.create') }}" class="btn btn-success mb-3">➕ Nouveau rendez-vous</a>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Médecin</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rendezvous as $rdv)
                <tr>
                    <td>{{ $rdv->id }}</td>
                    <td>{{ $rdv->patient->nom }}</td>
                    <td>{{ $rdv->medecin->nom }}</td>
                    <td>{{ $rdv->date }}</td>
                    <td>{{ $rdv->heure }}</td>
                    <td>{{ $rdv->statut }}</td>
                    <td>
                        <a href="{{ route('rendezvous.show', $rdv->id) }}" class="btn btn-info btn-sm">👁 Voir</a>
                        <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                        <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce rendez-vous ?')">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Aucun rendez-vous trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
