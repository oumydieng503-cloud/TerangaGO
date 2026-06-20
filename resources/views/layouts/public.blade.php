<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('transport.brand') }} — Voyagez au Sénégal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|syne:600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pattern-bg min-h-screen font-sans">
    @include('layouts.partials.toast')

    <header class="border-b border-sand-200/80 bg-white/90 backdrop-blur sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-display font-bold text-xl text-charcoal">
                <span class="text-terracotta">Teranga</span>Go
            </a>
            <nav class="flex items-center gap-4 text-sm font-medium">
                @auth
                    @if(auth()->user()->role === 'voyageur')
                        <a href="{{ route('voyageur.dashboard') }}" class="text-charcoal/70 hover:text-terracotta transition">Mes billets</a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-charcoal/70 hover:text-terracotta transition">Administration</a>
                    @else
                        <a href="{{ route('operateur.dashboard') }}" class="text-charcoal/70 hover:text-terracotta transition">Opérateur</a>
                    @endif
                @else
                    <a href="{{ route('voyageur.login') }}" class="text-charcoal/70 hover:text-terracotta transition">Espace voyageur</a>
                    <a href="{{ route('login') }}" class="text-charcoal/50 hover:text-charcoal transition">Pro</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="border-t border-sand-200 mt-16 py-8 text-center text-sm text-charcoal/50">
        <p>{{ config('transport.brand') }} — Réservation de transport interurbain au Sénégal</p>
        <p class="mt-1">Paiement Wave & Orange Money · Billet QR sécurisé</p>
    </footer>
</body>
</html>
