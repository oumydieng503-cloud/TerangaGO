<x-panel-layout header="Administration">
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <x-ui.stat label="Voyageurs" :value="$nbVoyageurs" color="sky" />
        <x-ui.stat label="Opérateurs" :value="$nbOperateurs" color="terracotta" />
        <x-ui.stat label="Lignes" :value="$nbLignes" color="forest" />
        <x-ui.stat label="Bus" :value="$nbBus" color="amber" />
        <x-ui.stat label="Trajets" :value="$nbTrajets" color="terracotta" />
        <x-ui.stat label="Réservations" :value="$nbReservations" color="forest" />
    </div>

    <x-ui.card>
        <h3 class="font-display font-semibold text-lg mb-5">Gestion de la plateforme</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <x-ui.button :href="route('admin.users.index')" variant="outline" class="justify-center">Utilisateurs</x-ui.button>
            <x-ui.button :href="route('admin.lignes.index')" variant="outline" class="justify-center">Lignes</x-ui.button>
            <x-ui.button :href="route('admin.buses.index')" variant="outline" class="justify-center">Bus</x-ui.button>
            <x-ui.button :href="route('admin.trajets.index')" variant="outline" class="justify-center">Trajets</x-ui.button>
        </div>
    </x-ui.card>
</x-panel-layout>
