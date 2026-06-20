<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Modifier un utilisateur</h2>
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

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe <span class="text-gray-400 text-xs">(laisser vide pour ne pas changer)</span></label>
                        <input type="password" name="password"
                            class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                            class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rôle</label>
                        <select name="role" class="mt-1 block w-full border rounded px-3 py-2" required>
                            <option value="voyageur" {{ old('role', $user->role) == 'voyageur' ? 'selected' : '' }}>Voyageur</option>
                            <option value="operateur" {{ old('role', $user->role) == 'operateur' ? 'selected' : '' }}>Opérateur</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                            Modifier
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-panel-layout>