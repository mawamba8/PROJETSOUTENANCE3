@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Dossier de {{ $patient->name }}</h2>
@if(session('ok'))<div class="p-3 bg-emerald-50 text-emerald-700 rounded mb-4">{{ session('ok') }}</div>@endif

@auth
@if(auth()->user()->isDoctor() || auth()->user()->isAdmin())
<form method="post" class="bg-white p-4 rounded-2xl shadow mb-6" action="{{ route('records.store',$patient) }}">
  @csrf
  <div class="grid gap-3">
    <input name="summary" placeholder="Résumé" class="border rounded-lg px-3 py-2">
    <textarea name="diagnosis" placeholder="Diagnostic" class="border rounded-lg px-3 py-2"></textarea>
    <textarea name="treatment" placeholder="Traitement" class="border rounded-lg px-3 py-2"></textarea>
  </div>
  <button class="mt-3 px-4 py-2 bg-emerald-500 text-white rounded-lg">Ajouter</button>
</form>
@endif
@endauth

<div class="bg-white rounded-2xl shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-50"><tr><th class="p-3">Date</th><th class="p-3">Médecin</th><th class="p-3">Résumé</th><th class="p-3">Statut</th><th class="p-3">Action</th></tr></thead>
    <tbody>
      @foreach($records as $r)
      <tr class="border-t">
        <td class="p-3">{{ $r->created_at->format('d/m/Y H:i') }}</td>
        <td class="p-3">{{ $r->doctor->name ?? '—' }}</td>
        <td class="p-3">{{ Str::limit($r->summary, 80) }}</td>
        <td class="p-3">{{ $r->locked_at ? 'Verrouillé' : 'Ouvert' }}</td>
        <td class="p-3">
          @if(!$r->locked_at && (auth()->user()->isDoctor() || auth()->user()->isAdmin()))
          <form method="post" action="{{ route('records.lock',$r) }}">@csrf
            <button class="text-xs px-2 py-1 bg-emerald-500 text-white rounded">Verrouiller</button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
