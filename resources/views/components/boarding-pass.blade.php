@props(['billet'])

@php $status = \App\Support\StatusLabel::billet($billet->statut); @endphp

<div id="boarding-pass-print" class="boarding-pass max-w-md mx-auto">
    <div class="p-6 pl-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <p class="font-display font-bold text-terracotta text-sm tracking-wide uppercase">TerangaGo</p>
                <p class="text-xs text-charcoal/50">Billet électronique</p>
            </div>
            <x-ui.badge :variant="$status['variant']">{{ $status['label'] }}</x-ui.badge>
        </div>

        <div class="flex items-center gap-3 mb-6">
            <div>
                <p class="text-xs text-charcoal/50 uppercase">Départ</p>
                <p class="font-display font-bold text-xl">{{ $billet->reservation->trajet->ligne->ville_depart }}</p>
            </div>
            <svg class="w-6 h-6 text-terracotta shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            <div>
                <p class="text-xs text-charcoal/50 uppercase">Arrivée</p>
                <p class="font-display font-bold text-xl">{{ $billet->reservation->trajet->ligne->ville_arrivee }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm mb-6">
            <div>
                <p class="text-charcoal/50">Date</p>
                <p class="font-medium">{{ \Carbon\Carbon::parse($billet->reservation->trajet->date_depart)->locale('fr')->isoFormat('D MMM YYYY') }}</p>
            </div>
            <div>
                <p class="text-charcoal/50">Heure</p>
                <p class="font-medium">{{ $billet->reservation->trajet->heure_depart }}</p>
            </div>
            <div>
                <p class="text-charcoal/50">Bus</p>
                <p class="font-medium">{{ $billet->reservation->trajet->bus->numero }}</p>
            </div>
            <div>
                <p class="text-charcoal/50">Places</p>
                <p class="font-medium">{{ $billet->reservation->nb_places }}</p>
            </div>
        </div>

        <div class="border-t border-dashed border-sand-200 pt-6 text-center">
            <img src="{{ route('voyageur.billets.qr', $billet) }}" alt="QR Code" class="mx-auto w-40 h-40">
            <p class="font-mono text-lg font-bold text-charcoal mt-3 tracking-widest">{{ $billet->code_billet }}</p>
            <p class="text-xs text-charcoal/50 mt-1">Présentez ce code à l'embarquement</p>
        </div>
    </div>
</div>
