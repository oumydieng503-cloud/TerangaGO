<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Réservations sur mes trajets</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">Liste des réservations</h3>

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Voyageur</th>
                            <th class="border px-4 py-2 text-left">Trajet</th>
                            <th class="border px-4 py-2 text-left">Date</th>
                            <th class="border px-4 py-2 text-left">Nb places</th>
                            <th class="border px-4 py-2 text-left">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $reservation->user->name }}</td>
                            <td class="border px-4 py-2">{{ $reservation->trajet->ligne->nom }}</td>
                            <td class="border px-4 py-2">{{ $reservation->trajet->date_depart }}</td>
                            <td class="border px-4 py-2">{{ $reservation->nb_places }}</td>
                            <td class="border px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($reservation->statut == 'confirmee') bg-green-100 text-green-700
                                    @elseif($reservation->statut == 'en_attente') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700
                                    @endif">
                                    {{ $reservation->statut }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-panel-layout>