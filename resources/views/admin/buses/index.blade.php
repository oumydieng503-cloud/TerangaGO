<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Gestion des Bus</h2>
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
                    <h3 class="text-lg font-semibold">Liste des bus</h3>
                    <a href="{{ route('admin.buses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouveau bus
                    </a>
                </div>

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Numéro</th>
                            <th class="border px-4 py-2 text-left">Capacité</th>
                            <th class="border px-4 py-2 text-left">Opérateur</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buses as $bus)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $bus->numero }}</td>
                            <td class="border px-4 py-2">{{ $bus->capacite }}</td>
                            <td class="border px-4 py-2">{{ $bus->operateur->name ?? 'Non assigné' }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.buses.edit', $bus) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" onsubmit="return confirm('Supprimer ce bus ?')">
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