<x-voyageur-layout header="Mes billets">
    @if($reservations->isEmpty())
        <x-ui.card class="text-center py-12">
            <p class="text-charcoal/50">Vous n'avez aucune réservation.</p>
            <x-ui.button :href="route('home')" class="mt-4">Rechercher un trajet</x-ui.button>
        </x-ui.card>
    @else
        <div class="space-y-4">
            @foreach($reservations as $reservation)
                @php
                    $resStatus = \App\Support\StatusLabel::reservation($reservation->statut);
                    $bilStatus = $reservation->billet ? \App\Support\StatusLabel::billet($reservation->billet->statut) : null;
                @endphp
                <x-ui.card>
                    <div class="flex justify-between items-start gap-4">
                        <div>
                            <p class="font-display font-bold text-lg">{{ $reservation->trajet->ligne->ville_depart }} → {{ $reservation->trajet->ligne->ville_arrivee }}</p>
                            <p class="text-sm text-charcoal/60 mt-1">
                                {{ \Carbon\Carbon::parse($reservation->trajet->date_depart)->locale('fr')->isoFormat('D MMM YYYY') }} · {{ $reservation->trajet->heure_depart }}
                            </p>
                            <p class="text-sm text-charcoal/60">{{ $reservation->nb_places }} place(s)</p>
                        </div>
                        <x-ui.badge :variant="$resStatus['variant']">{{ $resStatus['label'] }}</x-ui.badge>
                    </div>

                    @if($reservation->billet)
                        <div class="mt-4 pt-4 border-t border-sand-200 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ route('voyageur.billets.qr', $reservation->billet) }}" alt="QR" class="w-14 h-14 rounded-lg border border-sand-200">
                                <span class="font-mono text-sm">{{ $reservation->billet->code_billet }}</span>
                            </div>
                            <x-ui.badge :variant="$bilStatus['variant']">{{ $bilStatus['label'] }}</x-ui.badge>
                        </div>
                        <div class="mt-3 flex gap-2">
                            <x-ui.button :href="route('voyageur.reservations.success', $reservation->billet)" variant="ghost" class="text-sm py-1.5 px-3">Voir le billet</x-ui.button>
                        </div>
                    @endif
                </x-ui.card>
            @endforeach
        </div>
    @endif
</x-voyageur-layout>
