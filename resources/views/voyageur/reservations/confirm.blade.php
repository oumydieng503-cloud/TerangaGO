<x-voyageur-layout header="Paiement">
    <x-ui.stepper :steps="['Recherche', 'Places', 'Connexion', 'Paiement', 'Billet']" :current="4" />

    <x-ui.card>
        @if(session('error'))
            <x-ui.alert type="error" class="mb-4">{{ session('error') }}</x-ui.alert>
        @endif

        <h2 class="font-display font-semibold text-lg mb-4">Récapitulatif</h2>

        <div class="bg-sand-50 rounded-xl p-5 mb-6 border border-sand-200 space-y-2">
            <p class="font-display font-bold text-xl">{{ $trajet->ligne->ville_depart }} → {{ $trajet->ligne->ville_arrivee }}</p>
            <p class="text-sm text-charcoal/60">{{ \Carbon\Carbon::parse($trajet->date_depart)->locale('fr')->isoFormat('D MMM YYYY') }} à {{ $trajet->heure_depart }}</p>
            <p class="text-sm text-charcoal/60">Bus {{ $trajet->bus->numero }}</p>
            <hr class="border-sand-200 my-3">
            <div class="flex justify-between text-sm"><span>Places</span><strong>{{ $nbPlaces }}</strong></div>
            <div class="flex justify-between text-sm"><span>Prix unitaire</span><span>{{ number_format($trajet->prix, 0, ',', ' ') }} FCFA</span></div>
            <div class="flex justify-between text-lg font-display font-bold text-terracotta pt-2">
                <span>Total</span><span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>
        </div>

        <form action="{{ route('voyageur.reservations.pay') }}" method="POST" class="space-y-4">
            @csrf
            <p class="text-sm font-medium text-charcoal/80">Mode de paiement</p>
            <div class="grid grid-cols-2 gap-3">
                <label class="relative cursor-pointer">
                    <input type="radio" name="payment_method" value="wave" class="peer sr-only" checked>
                    <div class="rounded-xl border-2 border-sand-200 p-4 text-center peer-checked:border-terracotta peer-checked:bg-terracotta/5 transition">
                        <p class="font-semibold text-sky-600">Wave</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="payment_method" value="orange" class="peer sr-only">
                    <div class="rounded-xl border-2 border-sand-200 p-4 text-center peer-checked:border-terracotta peer-checked:bg-terracotta/5 transition">
                        <p class="font-semibold text-orange-600">Orange Money</p>
                    </div>
                </label>
            </div>

            <x-ui.button type="submit" variant="secondary" class="w-full">
                Payer {{ number_format($total, 0, ',', ' ') }} FCFA
            </x-ui.button>
        </form>

        <p class="text-xs text-charcoal/40 text-center mt-4">Paiement simulé — aucune transaction réelle.</p>
    </x-ui.card>
</x-voyageur-layout>
