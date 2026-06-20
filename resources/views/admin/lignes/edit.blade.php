<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Modifier une ligne</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.lignes.update', $ligne) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $ligne->nom) }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ville Départ</label>
                        <input type="text" name="ville_depart" value="{{ old('ville_depart', $ligne->ville_depart) }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ville Arrivée</label>
                        <input type="text" name="ville_arrivee" value="{{ old('ville_arrivee', $ligne->ville_arrivee) }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                            Modifier
                        </button>
                        <a href="{{ route('admin.lignes.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-panel-layout>