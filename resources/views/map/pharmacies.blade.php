@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-4">Pharmacies à proximité</h2>
<div id="map" class="w-full h-96 rounded-2xl shadow"></div>
<script>
  const map = L.map('map').setView([0,0], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{ maxZoom: 19 }).addTo(map);
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(pos=>{
      const {latitude, longitude} = pos.coords;
      map.setView([latitude, longitude], 14);
      L.marker([latitude, longitude]).addTo(map).bindPopup('Vous êtes ici');
      // Démo: 3 pharmacies fictives proches
      [[0.001,0.001,'Pharmacie A'],[-0.002,0.002,'Pharmacie B'],[0.003,-0.001,'Pharmacie C']]
        .forEach(([dx,dy,name])=>{
          L.marker([latitude+dx, longitude+dy]).addTo(map).bindPopup(name);
        });
    });
  }
</script>
@endsection
