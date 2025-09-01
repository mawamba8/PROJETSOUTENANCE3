<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet Médical Numérique</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Navbar transparente par défaut */
        .navbar {
            transition: background-color 0.4s ease, box-shadow 0.4s ease;
            background-color: rgba(0, 123, 255, 0.3); /* bleu clair semi-transparent */
        }
        /* Navbar après scroll */
        .navbar.scrolled {
            background-color: #0d6efd !important; /* bleu bootstrap plein */
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* Décalage du contenu pour compenser la navbar fixed */
        body {
            padding-top: 70px;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                🏥 Carnet Médical
            </a>
            <div>
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-warning">S’inscrire</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center text-center text-white" 
        style="background-image: url('{{ asset('assets/image/back.webp') }}'); 
               background-size: cover; 
               background-position: center; 
               min-height: 100vh;">

        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Bienvenue sur votre Carnet Médical Numérique</h1>
            <p class="lead">
                Gérez vos rendez-vous médicaux, suivez vos consultations et gardez votre historique de santé en toute simplicité.
            </p>
            <div class="mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2 px-4">Accéder à mon espace</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Créer un compte</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-5 border-top">
        <div class="container">
            <div class="row text-center">
                 <h2 class="mb-4"><span style="color: blue;">nos services</span></h2>
                <!-- Feature 1 -->
                <div class="col-md-4 mb-9">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">📅 Rendez-vous</h5>
                            <p class="card-text">Prenez vos rendez-vous médicaux en ligne et recevez des rappels automatiques.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4 mb-9">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-success">🩺 Consultations</h5>
                            <p class="card-text">Accédez à vos diagnostics et prescriptions, triés par date et par médecin.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4 mb-9">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-danger">📖 Carnet Médical</h5>
                            <p class="card-text">Un historique centralisé de vos soins, disponible à tout moment et sécurisé.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="about-section py-5">
      <div class="container">
        <div class="row align-center">
          <div class="col-md-8">
            <h2 class="mb-4"><span style="color: blue;">À propos de nous</span></h2>
            <p class="lead text-muted">
              GFI SARL est une entreprise leader spécialisée dans la vente et la fabrication de matériel de plomberie.  
              Nous fournissons des pièces de haute qualité adaptées aux besoins des professionnels et particuliers.  
              Notre mission est de garantir durabilité, fiabilité et performance dans toutes vos installations.  
              Avec une équipe technique experte, nous accompagnons chaque projet de sa conception à sa réalisation.
            </p>
          </div>
          <div class="col-md-4 text-end">
            <img src="{{asset('assets/image/OIP.webp') }}" alt="a propos" class="img-fluid rounded shadow" style="max-width:350px;">
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center py-5 bg-primary text-white">
        <div class="container">
            <h2 class="fw-bold mb-4">Prêt à commencer ?</h2>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Créer mon compte</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Carnet Médical Numérique. Tous droits réservés.</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour changer la navbar au scroll -->
    <script>
        window.addEventListener("scroll", function() {
            let navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>
</body>
</html>
