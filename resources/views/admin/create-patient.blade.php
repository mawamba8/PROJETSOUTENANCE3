@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Créer un compte Patient
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.create.patient.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nom complet</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse">
                        </div>

                        <button type="submit" class="btn btn-success">Créer le compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
