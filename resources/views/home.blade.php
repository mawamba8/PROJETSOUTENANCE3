@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Système Médical - Page d'accueil</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Comptes de test créés :</h4>
                    
                    <div class="alert alert-info">
                        <strong>Administrateur:</strong><br>
                         Email: admin@medical.com<br>
                        Password: password
                    </div>

                    <div class="alert alert-success">
                        <strong>Médecin:</strong><br>
                        Email: medecin@medical.com<br>
                        Password: password
                    </div>

                    <div class="alert alert-warning">
                        <strong>Patient:</strong><br>
                        Email: patient@medical.com<br>
                        Password: password
                    </div>

                    <p>Connectez-vous pour accéder à votre tableau de bord.</p>
                    
                    <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">S'inscrire</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


