<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Mes Trajets</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Liste de mes trajets</h3>
                    <a href="{{ route('operateur.trajets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouveau trajet
                    </a>
                </div>

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Ligne</th>
                            <th class="border px-4 py-2 text-left">Bus</th>
                            <th class="border px-4 py-2 text-left">Date départ</th>
                            <th class="border px-4 py-2 text-left">Heure départ</th>
                            <th class="border px-4 py-2 text-left">Prix</th>
                            <th class="border px-4 py-2 text-left">Places dispo</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trajets as $trajet)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $trajet->ligne->nom }}</td>
                            <td class="border px-4 py-2">{{ $trajet->bus->numero }}</td>
                            <td class="border px-4 py-2">{{ $trajet->date_depart }}</td>
                            <td class="border px-4 py-2">{{ $trajet->heure_depart }}</td>
                            <td class="border px-4 py-2">{{ $trajet->prix }}</td>
                            <td class="border px-4 py-2">{{ $trajet->places_dispo }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('operateur.trajets.edit', $trajet) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                        Modifier
                                    </a>
                                    <form action="{{ route('operateur.trajets.destroy', $trajet) }}" method="POST" onsubmit="return confirm('Supprimer ce trajet ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-panel-layout>