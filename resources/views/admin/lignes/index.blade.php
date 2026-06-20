<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Gestion des Lignes</h2>
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
                    <h3 class="text-lg font-semibold">Liste des lignes</h3>
                    <a href="{{ route('admin.lignes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouvelle ligne
                    </a>
                </div>

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Nom</th>
                            <th class="border px-4 py-2 text-left">Ville Départ</th>
                            <th class="border px-4 py-2 text-left">Ville Arrivée</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lignes as $ligne)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $ligne->nom }}</td>
                            <td class="border px-4 py-2">{{ $ligne->ville_depart }}</td>
                            <td class="border px-4 py-2">{{ $ligne->ville_arrivee }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.lignes.edit', $ligne) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.lignes.destroy', $ligne) }}" method="POST" onsubmit="return confirm('Supprimer cette ligne ?')">
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