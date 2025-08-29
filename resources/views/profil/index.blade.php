@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mon Profil</h1>
    <p>Bienvenue sur la page profil.</p>

    <a href="{{ route('profil.edit') }}" class="btn btn-primary">
        Modifier mon profil
    </a>
</div>
@endsection
