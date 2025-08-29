@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Mes Consultations</h1>

    @forelse ($consultations as $consultation)
        <div class="bg-white p-4 rounded-xl shadow mb-4">
            <p class="text-sm text-gray-500">{{ $consultation->date->format('d M Y') }}</p>
            <h2 class="font-semibold">🩺 {{ $consultation->diagnostic }}</h2>
            <p class="text-gray-600">💊 Prescription : {{ $consultation->prescription }}</p>
        </div>
    @empty
        <p>Aucune consultation enregistrée.</p>
    @endforelse
</div>
@endsection
