<x-public-layout>
    <div class="max-w-md mx-auto px-4 py-16">
        <x-ui.card>
            <div class="text-center mb-8">
                <p class="font-display font-bold text-2xl"><span class="text-terracotta">Teranga</span>Go</p>
                <p class="text-charcoal/60 text-sm mt-2">Espace professionnel — Admin & Opérateur</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <x-ui.input label="Email" name="email" type="email" :value="old('email')" required autofocus />
                @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

                <x-ui.input label="Mot de passe" name="password" type="password" required />
                @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

                <label class="flex items-center gap-2 text-sm text-charcoal/70">
                    <input type="checkbox" name="remember" class="rounded border-sand-300 text-terracotta focus:ring-terracotta">
                    Se souvenir de moi
                </label>

                <x-ui.button type="submit" class="w-full">Connexion</x-ui.button>
            </form>

            <p class="text-center text-sm text-charcoal/50 mt-6">
                Voyageur ? <a href="{{ route('voyageur.login') }}" class="text-terracotta hover:underline">Connexion par SMS</a>
            </p>
        </x-ui.card>
    </div>
</x-public-layout>
