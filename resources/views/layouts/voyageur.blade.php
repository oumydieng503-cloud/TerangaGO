<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mon espace' }} — {{ config('transport.brand') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|syne:600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pattern-bg min-h-screen font-sans pb-20">
    @include('layouts.partials.toast')

    <header class="border-b border-sand-200/80 bg-white/90 backdrop-blur sticky top-0 z-40">
        <div class="max-w-3xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-display font-bold text-lg text-charcoal">
                <span class="text-terracotta">Teranga</span>Go
            </a>
            @isset($header)
                <h1 class="text-sm font-semibold text-charcoal/70">{{ $header }}</h1>
            @endisset
            <form method="POST" action="{{ route('voyageur.logout') }}">
                @csrf
                <button type="submit" class="text-sm text-charcoal/50 hover:text-terracotta">Déconnexion</button>
            </form>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <nav class="fixed bottom-0 inset-x-0 bg-white border-t border-sand-200 z-50 safe-area-pb">
        <div class="max-w-3xl mx-auto flex justify-around py-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 px-4 py-2 text-xs {{ request()->routeIs('home') ? 'text-terracotta font-semibold' : 'text-charcoal/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Rechercher
            </a>
            <a href="{{ route('voyageur.dashboard') }}" class="flex flex-col items-center gap-1 px-4 py-2 text-xs {{ request()->routeIs('voyageur.dashboard') || request()->routeIs('voyageur.reservations.*') ? 'text-terracotta font-semibold' : 'text-charcoal/50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                Mes billets
            </a>
        </div>
    </nav>
</body>
</html>
