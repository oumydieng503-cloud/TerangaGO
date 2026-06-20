<x-public-layout>
    <div class="max-w-md mx-auto px-4 py-12">
        <x-ui.stepper :steps="['Recherche', 'Places', 'Connexion', 'Paiement', 'Billet']" :current="1" />

        <x-ui.card>
            <h1 class="font-display font-bold text-xl mb-6">Choisir vos places</h1>

            <div class="bg-sand-50 rounded-xl p-4 mb-6 border border-sand-200">
                <p class="font-display font-semibold text-lg">{{ $trajet->ligne->ville_depart }} → {{ $trajet->ligne->ville_arrivee }}</p>
                <p class="text-sm text-charcoal/60 mt-1">{{ \Carbon\Carbon::parse($trajet->date_depart)->locale('fr')->isoFormat('ddd D MMM YYYY') }} à {{ $trajet->heure_depart }}</p>
                <p class="text-sm text-charcoal/60">{{ $trajet->places_dispo }} places disponibles</p>
                <p class="text-terracotta font-bold mt-2">{{ number_format($trajet->prix, 0, ',', ' ') }} FCFA / place</p>
            </div>

            @if($errors->any())
                <x-ui.alert type="error" class="mb-4">{{ $errors->first() }}</x-ui.alert>
            @endif

            <form action="{{ route('voyageur.reservations.choose-seats', $trajet) }}" method="POST" class="space-y-4">
                @csrf
                <x-ui.input label="Nombre de places" name="nb_places" type="number" min="1" :max="$trajet->places_dispo" value="1" required />
                <x-ui.button type="submit" class="w-full">Continuer</x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-public-layout>
