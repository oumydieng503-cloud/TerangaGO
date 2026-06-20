@props(['trajet'])

<div class="bg-white rounded-2xl shadow-card border border-sand-200/80 clip-route p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-warm transition">
    <div class="flex-1">
        <div class="flex items-center gap-2 mb-2">
            <span class="font-display font-bold text-lg text-charcoal">{{ $trajet->ligne->ville_depart }}</span>
            <svg class="w-5 h-5 text-terracotta shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            <span class="font-display font-bold text-lg text-charcoal">{{ $trajet->ligne->ville_arrivee }}</span>
        </div>
        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-charcoal/60">
            <span>{{ \Carbon\Carbon::parse($trajet->date_depart)->locale('fr')->isoFormat('ddd D MMM YYYY') }}</span>
            <span>{{ $trajet->heure_depart }}</span>
            <span>Bus {{ $trajet->bus->numero }}</span>
        </div>
        <div class="mt-3 flex items-center gap-2">
            @php
                $capacite = $trajet->bus->capacite ?? $trajet->places_dispo;
                $pct = $capacite > 0 ? min(100, ($trajet->places_dispo / $capacite) * 100) : 0;
            @endphp
            <div class="flex-1 max-w-[120px] h-1.5 bg-sand-200 rounded-full overflow-hidden">
                <div class="h-full bg-forest rounded-full" style="width: {{ $pct }}%"></div>
            </div>
            <span class="text-xs font-medium text-forest">{{ $trajet->places_dispo }} places</span>
        </div>
    </div>
    <div class="text-right shrink-0">
        <p class="font-display text-2xl font-bold text-terracotta">{{ number_format($trajet->prix, 0, ',', ' ') }} <span class="text-sm font-sans font-normal text-charcoal/60">FCFA</span></p>
        <x-ui.button :href="route('voyageur.reservations.create', $trajet)" class="mt-3">Réserver</x-ui.button>
    </div>
</div>
