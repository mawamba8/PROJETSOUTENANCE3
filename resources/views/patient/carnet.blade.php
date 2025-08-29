@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📒 Mon Carnet Médical</h2>

    <div class="card shadow p-4">
        <p><strong>Patient :</strong> {{ auth()->user()->name }}</p>
        <p><strong>Historique médical :</strong></p>
        <div class="border p-3 bg-light">
            {{ $dossier->historique }}
        </div>
    </div>
</div>
@endsection
