<!DOCTYPE html>
<html><head><meta charset="utf-8"><style>
body{font-family: DejaVu Sans, sans-serif; font-size:12px;}
h1{color:#10b981; font-size:18px}
.box{border:1px solid #ddd; padding:10px; border-radius:8px}
</style></head><body>
<h1>Ordonnance #{{ $p->id }}</h1>
<p><b>Patient:</b> {{ $p->patient->name }} — <b>Médecin:</b> {{ $p->doctor->name }}</p>
<div class="box">
  <ul>
    @foreach($p->items as $it)
    <li><b>{{ $it->drug }}</b> — {{ $it->dosage }}, {{ $it->frequency }} ({{ $it->duration }})</li>
    @endforeach
  </ul>
</div>
<p style="margin-top:20px; color:#666">Généré par {{ config('app.name') }}</p>
</body></html>
