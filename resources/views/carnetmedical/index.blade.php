@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Carnets Médicaux</h1>

    <a href="{{ route('carnetmedicals.create') }}" class="btn btn-success mb-3">➕ Nouveau carnet médical</a>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Antécédents</th>
                <th>Allergies</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carnetmedicals as $carnet)
                <tr>
                    <td>{{ $carnet->id }}</td>
                    <td>{{ $carnet->patient->nom }}</td>
                    <td>{{ $carnet->antecedents }}</td>
                    <td>{{ $carnet->allergies }}</td>
                    <td>{{ $carnet->notes }}</td>
                    <td>
                        <a href="{{ route('carnetmedicals.show', $carnet->id) }}" class="btn btn-info btn-sm">👁 Voir</a>
                        <a href="{{ route('carnetmedicals.edit', $carnet->id) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                        <form action="{{ route('carnetmedicals.destroy', $carnet->id) }}" method="POST" style="display:inline-block;">
                         @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce carnet médical ?')">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Aucun carnet médical trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


