@extends('layouts.app')

@section('content')
    <h1>Liste des patients</h1>

    <ul>
        @foreach($patients as $patient)
            <li>{{ $patient->name }} - {{ $patient->email }}</li>
        @endforeach
    </ul>
@endsection
