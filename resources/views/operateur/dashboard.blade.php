<x-panel-layout header="Tableau de bord">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <x-ui.stat label="Mes bus" :value="$nbBus" color="terracotta" />
        <x-ui.stat label="Mes trajets" :value="$nbTrajets" color="amber" />
        <x-ui.stat label="Réservations" :value="$nbReservations" color="sky" />
        <x-ui.stat label="Places disponibles" :value="$totalPlacesDispo" color="forest" />
    </div>

    <x-ui.card class="mb-6">
        <h3 class="font-display font-semibold text-lg mb-4">Départs aujourd'hui</h3>
        @if($departsDuJour->isEmpty())
            <p class="text-charcoal/50">Aucun départ prévu aujourd'hui.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-charcoal/50 border-b border-sand-200">
                            <th class="pb-3 font-medium">Ligne</th>
                            <th class="pb-3 font-medium">Heure</th>
                            <th class="pb-3 font-medium">Places</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-100">
                        @foreach($departsDuJour as $trajet)
                        <tr>
                            <td class="py-3 font-medium">{{ $trajet->ligne->ville_depart }} → {{ $trajet->ligne->ville_arrivee }}</td>
                            <td class="py-3">{{ $trajet->heure_depart }}</td>
                            <td class="py-3">{{ $trajet->places_dispo }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-ui.card>

    <div class="flex flex-wrap gap-3">
        <x-ui.button :href="route('operateur.billets.index')">Valider des billets</x-ui.button>
        <x-ui.button :href="route('operateur.trajets.index')" variant="outline">Gérer les trajets</x-ui.button>
    </div>
</x-panel-layout>
