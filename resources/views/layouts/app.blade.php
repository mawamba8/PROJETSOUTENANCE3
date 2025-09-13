<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" class="h-full dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ config('app.name') }}</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Leaflet (pour la carte pharmacies) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    :root{ --brand:#10b981; --brand2:#0ea5e9; }

    /* Style bulles du chatbot */
    #chatLog div { 
      padding: 8px 12px; 
      border-radius: 12px; 
      margin-bottom: 6px; 
      max-width: 85%; 
    }
    #chatLog .user { 
      background:#f1f5f9; 
      text-align:right; 
      margin-left:auto; 
    }
    #chatLog .bot { 
      background:#d1fae5; 
      text-align:left; 
      margin-right:auto; 
      color:#065f46; 
    }
  </style>
</head>
<body class="min-h-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

  <!-- Header -->
  <header class="bg-gradient-to-r from-emerald-500 to-cyan-500 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between text-white">
      <div class="flex items-center gap-3">
        <img src="{{ asset('images/OIP.webp') }}" alt="Logo" class="w-10 h-10 rounded-xl bg-white p-1">
        <h1 class="text-xl font-semibold">{{ config('app.name') }}</h1>
      </div>
      <nav class="flex items-center gap-4 text-sm font-medium">
        <a href="/dashboard" class="hover:underline">Dashboard</a>
        <a href="{{ route('pharmacies.map') }}" class="hover:underline">Pharmacies</a>
        <a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a>
        <form method="post" action="{{ route('logout') }}">
          @csrf
          <button class="px-3 py-2 bg-white text-emerald-600 rounded-xl hover:bg-gray-100">Déconnexion</button>
        </form>
      </nav>
    </div>
  </header>

  <!-- Main content -->
  <main class="max-w-7xl mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6">
      @yield('content')
    </div>
  </main>

  <footer class="bg-emerald-700 text-white py-6 mt-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
    <div>
      <h4 class="font-semibold mb-2">Carnet Médical</h4>
      <p class="text-sm">Votre solution numérique pour suivre vos patients et rendez-vous.</p>
    </div>

    <div>
      <h4 class="font-semibold mb-2">Liens utiles</h4>
      <ul class="text-sm space-y-1">
        <li><a href="#" class="hover:underline hover:text-emerald-300 transition">Accueil</a></li>
        <li><a href="#" class="hover:underline hover:text-emerald-300 transition">Rendez-vous</a></li>
        <li><a href="#" class="hover:underline hover:text-emerald-300 transition">Patients</a></li>
        <li><a href="#" class="hover:underline hover:text-emerald-300 transition">Contact</a></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold mb-2">Contact</h4>
      <p class="text-sm">Email: contact@carnetmedical.com</p>
      <p class="text-sm">Tel: +237 699 999 999</p>
      <p class="text-sm">Douala, Cameroun</p>
    </div>
  </div>

  <div class="text-center text-sm mt-6 border-t border-emerald-600 pt-4">
    &copy; {{ date('Y') }} Carnet Médical. Tous droits réservés.
  </div>
</footer>



  <!-- Chatbot flottant -->
  <button id="chatBtn" class="fixed bottom-6 right-6 p-4 rounded-full shadow-lg bg-emerald-500 text-white hover:bg-emerald-600">💬</button>
  <div id="chatBox" class="hidden fixed bottom-20 right-6 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-3 bg-emerald-600 text-white font-semibold">Assistant</div>
    <div id="chatLog" class="p-3 h-64 overflow-y-auto text-sm"></div>
    <div class="p-3 border-t flex gap-2 dark:border-gray-700">
      <input id="chatInput" class="flex-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600" placeholder="Pose ta question...">
      <button id="chatSend" class="px-3 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">Envoyer</button>
    </div>
  </div>

  <script>
    const role = @json(auth()->check()?auth()->user()->role:'guest');
    const systemHints = {
      admin: "Je suis l’assistant Admin: je peux expliquer les chiffres, dashboards, et règles.",
      doctor:"Je suis l’assistant Médecin: je peux résumer un dossier, préparer une ordonnance.",
      patient:"Je suis l’assistant Patient: je t’aide à voir tes rendez-vous, ordonnances, pharmacies."
    };

    document.getElementById('chatBtn').onclick = () => 
      document.getElementById('chatBox').classList.toggle('hidden');

    document.getElementById('chatSend').onclick = () => {
      const box = document.getElementById('chatLog'); 
      const q = document.getElementById('chatInput'); 
      if(!q.value.trim()) return;
      box.innerHTML += `<div class="user"><b>Vous:</b> ${q.value}</div>`;
      const hint = systemHints[role] || "Assistant général";
      box.innerHTML += `<div class="bot"><b>${role}Bot:</b> ${hint}. "${q.value}" reçu.</div>`;
      q.value = '';
      box.scrollTop = box.scrollHeight;
    };
  </script>
</body>
</html>
