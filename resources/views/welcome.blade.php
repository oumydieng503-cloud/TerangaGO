<x-public-layout>
    <section class="max-w-6xl mx-auto px-4 py-12 md:py-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-charcoal leading-tight">
                Voyagez au <span class="text-terracotta">Sénégal</span>,<br>simplement.
            </h1>
            <p class="mt-4 text-charcoal/60 text-lg">Réservez votre place en car interurbain. Paiement Wave ou Orange Money, billet QR instantané.</p>
        </div>

        <x-ui.card class="max-w-4xl mx-auto mb-12">
            <h2 class="font-display font-semibold text-lg mb-5">Rechercher un trajet</h2>
            <form action="{{ route('home') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-ui.input label="Ville de départ" name="ville_depart" :value="request('ville_depart')" placeholder="Ex: Dakar" list="cities-depart" datalist="cities-depart" />
                <x-ui.input label="Ville d'arrivée" name="ville_arrivee" :value="request('ville_arrivee')" placeholder="Ex: Thiès" list="cities-arrivee" datalist="cities-arrivee" />
                <x-ui.input label="Date" name="date" type="date" :value="request('date', today()->format('Y-m-d'))" />
                <div class="flex items-end">
                    <x-ui.button type="submit" class="w-full">Rechercher</x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <div class="max-w-4xl mx-auto">
            <h2 class="font-display font-semibold text-xl mb-5">Trajets disponibles</h2>

            @if($trajets->isEmpty())
                <x-ui.card class="text-center py-12">
                    <p class="text-charcoal/50">Aucun trajet trouvé pour ces critères.</p>
                    <p class="text-sm text-charcoal/40 mt-2">Essayez une autre date ou une autre destination.</p>
                </x-ui.card>
            @else
                <div class="space-y-4">
                    @foreach($trajets as $trajet)
                        <x-trajet-card :trajet="$trajet" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="bg-charcoal text-white py-16 mt-8">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="font-display text-2xl font-bold text-center mb-10">Comment ça marche ?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-terracotta/20 text-terracotta font-bold flex items-center justify-center mx-auto mb-4">1</div>
                    <h3 class="font-semibold mb-2">Recherchez</h3>
                    <p class="text-sm text-white/60">Choisissez votre ville de départ, d'arrivée et la date du voyage.</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-terracotta/20 text-terracotta font-bold flex items-center justify-center mx-auto mb-4">2</div>
                    <h3 class="font-semibold mb-2">Payez</h3>
                    <p class="text-sm text-white/60">Réglez via Wave ou Orange Money depuis votre téléphone.</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-terracotta/20 text-terracotta font-bold flex items-center justify-center mx-auto mb-4">3</div>
                    <h3 class="font-semibold mb-2">Voyagez</h3>
                    <p class="text-sm text-white/60">Présentez votre billet QR à l'embarquement. C'est tout.</p>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
