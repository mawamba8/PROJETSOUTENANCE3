@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Liste des Patients</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">+ Ajouter</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Nom</th><th>Prénom</th><th>Date naissance</th><th>Email</th><th>Téléphone</th><th>Sexe</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->id }}</td>
            <td>{{ $patient->nom }}</td>
            <td>{{ $patient->prenom }}</td>
            <td>{{ $patient->date_naissance }}</td>
            <td>{{ $patient->email }}</td>
            <td>{{ $patient->telephone }}</td>
            <td>{{ $patient->sexe }}</td>
            <td>
                <a href="{{ route('patients.show',$patient->id) }}" class="btn btn-info btn-sm">Voir</a>
                <a href="{{ route('patients.edit',$patient,) }}" class="btn btn-warning btn-sm">Modifier</a>
                <form action="{{ route('patients.destroy',$patient->id) }}" method="POST" class="d-inline">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
