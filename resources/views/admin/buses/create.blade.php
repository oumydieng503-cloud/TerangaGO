<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Ajouter un bus</h2>
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

                <form action="{{ route('admin.buses.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Numéro</label>
                        <input type="text" name="numero" value="{{ old('numero') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Capacité</label>
                        <input type="number" name="capacite" value="{{ old('capacite') }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required min="1">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Opérateur</label>
                        <select name="operateur_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                            <option value="">-- Choisir un opérateur --</option>
                            @foreach($operateurs as $operateur)
                                <option value="{{ $operateur->id }}" {{ old('operateur_id') == $operateur->id ? 'selected' : '' }}>
                                    {{ $operateur->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Créer
                        </button>
                        <a href="{{ route('admin.buses.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-panel-layout>