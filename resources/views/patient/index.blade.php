@extends('layouts.app')

@section('content')
<h3>Liste des Patients</h3>
<a href="{{ route('patients.create') }}" class="btn btn-success mb-3">+ Ajouter un patient</a>
@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($patients as $patient)
        <tr>
            <td>{{ $patient->id }}</td>
            <td>{{ $patient->nom }}</td>
            <td>{{ $patient->Prenom }}</td>
            <td>{{ $patient->email }}</td>
            <td>{{ $patient->telephone }}</td>
            <td>
                <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Aucun patient enregistré</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection