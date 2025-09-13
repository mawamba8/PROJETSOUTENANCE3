@extends('layouts.app')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow">
  <div class="flex justify-between items-center">
    <h2 class="text-xl font-semibold">Ordonnance #{{ $prescription->id }}</h2>
    <a href="{{ route('prescriptions.pdf',$prescription->id) }}" class="px-4 py-2 bg-emerald-500 text-white rounded-lg">Télécharger PDF</a>
  </div>
  <div class="mt-4">
    <div class="font-semibold">{{ $prescription->title }}</div>
    <p class="text-gray-600">{{ $prescription->notes }}</p>
    <ul class="mt-4 list-disc pl-5">
      @foreach($prescription->items as $it)
      <li><b>{{ $it->drug }}</b> — {{ $it->dosage }}, {{ $it->frequency }} ({{ $it->duration }})</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
