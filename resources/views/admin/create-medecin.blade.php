@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer un compte Médecin</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.create.medecin.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nom complet</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                        </div>

                        <div class="form-group">
                            <label for="specialite">Spécialité</label>
                            <input type="text" class="form-control" id="specialite" name="specialite" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer le compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

