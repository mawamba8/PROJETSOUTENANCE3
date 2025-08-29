@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Mes Rendez-vous</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('patient.rendezvous.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow mb-6">
        @csrf
        <div class="mb-3">
            <label>Médecin</label>
            <select name="medecin_id" class="form-control">
                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}">{{ $medecin->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control">
  </div>

        <button type="submit" class="btn btn-success">Prendre rendez-vous</button>
    </form>

    <h2 class="text-xl font-semibold mb-3">Historique</h2>
    @foreach($rendezvous as $rdv)
        <div class="bg-white p-4 rounded-xl shadow mb-3">
            <p>{{ $rdv->date->format('d M Y') }} avec Dr. {{ $rdv->medecin->name }} - 
                <span class="badge bg-{{ $rdv->statut == 'validé' ? 'success' : 'warning' }}">
                    {{ ucfirst($rdv->statut) }}
                </span>
            </p>
        </div>
    @endforeach
</div>
@endsection

