<x-voyageur-layout header="Billet confirmé">
    <x-ui.stepper :steps="['Recherche', 'Places', 'Connexion', 'Paiement', 'Billet']" :current="5" />

    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 mb-3">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h2 class="font-display font-bold text-xl">Votre billet est prêt</h2>
        <p class="text-charcoal/60 text-sm mt-1">Conservez-le pour le jour du départ</p>
    </div>

    <x-boarding-pass :billet="$billet" />

    <div class="flex flex-col sm:flex-row gap-3 mt-6">
        <x-ui.button :href="route('voyageur.billets.pdf', $billet)" variant="outline" class="flex-1 justify-center" target="_blank">
            Télécharger / Imprimer
        </x-ui.button>
        <x-ui.button :href="route('voyageur.dashboard')" class="flex-1 justify-center">
            Mes billets
        </x-ui.button>
    </div>
</x-voyageur-layout>
