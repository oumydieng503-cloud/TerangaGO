@php
    $role = auth()->user()->role;
    $isAdmin = $role === 'admin';
    $link = 'block rounded-lg px-3 py-2.5 text-sm transition';
    $idle = 'text-white/70 hover:bg-white/10 hover:text-white';
    $active = 'bg-terracotta/20 text-white font-medium';
@endphp

<aside class="hidden lg:flex lg:flex-col w-64 bg-charcoal text-white shrink-0 min-h-screen">
    <div class="p-6 border-b border-white/10">
        <a href="{{ $isAdmin ? route('admin.dashboard') : route('operateur.dashboard') }}" class="font-display font-bold text-xl">
            <span class="text-terracotta">Teranga</span>Go
        </a>
        <p class="text-xs text-white/50 mt-1">{{ $isAdmin ? 'Administration' : 'Espace opérateur' }}</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        @if($isAdmin)
            <a href="{{ route('admin.dashboard') }}" class="{{ $link }} {{ request()->routeIs('admin.dashboard') ? $active : $idle }}">Tableau de bord</a>
            <a href="{{ route('admin.users.index') }}" class="{{ $link }} {{ request()->routeIs('admin.users.*') ? $active : $idle }}">Utilisateurs</a>
            <a href="{{ route('admin.lignes.index') }}" class="{{ $link }} {{ request()->routeIs('admin.lignes.*') ? $active : $idle }}">Lignes</a>
            <a href="{{ route('admin.buses.index') }}" class="{{ $link }} {{ request()->routeIs('admin.buses.*') ? $active : $idle }}">Bus</a>
            <a href="{{ route('admin.trajets.index') }}" class="{{ $link }} {{ request()->routeIs('admin.trajets.*') ? $active : $idle }}">Trajets</a>
        @else
            <a href="{{ route('operateur.dashboard') }}" class="{{ $link }} {{ request()->routeIs('operateur.dashboard') ? $active : $idle }}">Tableau de bord</a>
            <a href="{{ route('operateur.trajets.index') }}" class="{{ $link }} {{ request()->routeIs('operateur.trajets.*') ? $active : $idle }}">Mes trajets</a>
            <a href="{{ route('operateur.reservations.index') }}" class="{{ $link }} {{ request()->routeIs('operateur.reservations.*') ? $active : $idle }}">Réservations</a>
            <a href="{{ route('operateur.billets.index') }}" class="{{ $link }} {{ request()->routeIs('operateur.billets.*') ? $active : $idle }}">Valider billets</a>
        @endif
    </nav>
    <div class="p-4 border-t border-white/10">
        <p class="text-xs text-white/40 mb-2">{{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-white/60 hover:text-white">Déconnexion</button>
        </form>
    </div>
</aside>
