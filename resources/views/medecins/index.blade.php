@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Liste des Médecins</h1>

    <a href="{{ route('medecins.create') }}" class="btn btn-success mb-3">➕ Ajouter un médecin</a>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medecins as $medecin)
                <tr>
                    <td>{{ $medecin->id }}</td>
                    <td>{{ $medecin->nom }}</td>
                    <td>{{ $medecin->specialite }}</td>
                    <td>{{ $medecin->email }}</td>
                    <td>{{ $medecin->telephone }}</td>
                    <td>
                        <a href="{{ route('medecins.show', $medecin->id) }}" class="btn btn-info btn-sm">👁 Voir</a>
                        <a href="{{ route('medecins.edit', $medecin->id) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                        <form action="{{ route('medecins.destroy', $medecin->id) }}" method="POST" style="display:inline-block;">
                             @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce médecin ?')">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Aucun médecin trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

