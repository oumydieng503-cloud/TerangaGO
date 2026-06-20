<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Créer un trajet</h2>
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

                <form action="{{ route('admin.trajets.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ligne</label>
                        <select name="ligne_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                            <option value="">-- Choisir une ligne --</option>
                            @foreach($lignes as $ligne)
                                <option value="{{ $ligne->id }}" {{ old('ligne_id') == $ligne->id ? 'selected' : '' }}>
                                    {{ $ligne->nom }} ({{ $ligne->ville_depart }} → {{ $ligne->ville_arrivee }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Bus</label>
                        <select name="bus_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                            <option value="">-- Choisir un bus --</option>
                            @foreach($buses as $bus)
                                <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                    {{ $bus->numero }} ({{ $bus->capacite }} places)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Date de départ</label>
                        <input type="date" name="date_depart" value="{{ old('date_depart') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Heure de départ</label>
                        <input type="time" name="heure_depart" value="{{ old('heure_depart') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                        <input type="number" name="prix" value="{{ old('prix') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required min="0" step="0.01">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Places disponibles</label>
                        <input type="number" name="places_dispo" value="{{ old('places_dispo') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required min="0">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Créer
                        </button>
                        <a href="{{ route('admin.trajets.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-panel-layout>