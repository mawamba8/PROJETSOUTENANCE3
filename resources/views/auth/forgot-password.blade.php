@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 420px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" width="80" class="mb-2">
            <h3 class="fw-bold text-primary">Connexion</h3>
            <p class="text-muted">Accédez à votre carnet médical numérique</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="Entrez votre email" required autofocus>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="••••••••" required>
            </div>

            <!-- Remember me + Forgot password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Mot de passe oublié ?</a>
            </div>

            <!-- Submit -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                </button>
            </div>

            <!-- Register link -->
            <p class="text-center text-muted mb-0">
                Pas encore de compte ? <a href="{{ route('register') }}" class="fw-bold text-primary">S’inscrire</a>
            </p>
        </form>
    </div>
</div>
@endsection
