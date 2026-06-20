<x-public-layout>
    <div class="max-w-md mx-auto px-4 py-16">
        <x-ui.card>
            <div class="text-center mb-8">
                <p class="font-display font-bold text-xl">Vérification SMS</p>
                <p class="text-charcoal/60 text-sm mt-2">Code envoyé au {{ $telephone }}</p>
            </div>

            @if(session('otp_debug'))
                <x-ui.alert type="warning" class="mb-4 text-center">
                    Mode démo — Votre code : <strong>{{ session('otp_debug') }}</strong>
                </x-ui.alert>
            @endif

            @if(session('error'))
                <x-ui.alert type="error" class="mb-4">{{ session('error') }}</x-ui.alert>
            @endif

            <x-ui.stepper :steps="['Recherche', 'Places', 'Connexion', 'Paiement', 'Billet']" :current="3" />

            <form action="{{ route('voyageur.verify-otp') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="telephone" value="{{ $telephone }}">
                <x-ui.input label="Code à 4 chiffres" name="otp_code" maxlength="4" required
                    class="text-center text-2xl tracking-[0.5em] font-mono" />
                <x-ui.button type="submit" class="w-full">Vérifier</x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-public-layout>
