<x-public-layout>
    <div class="max-w-md mx-auto px-4 py-16">
        <x-ui.card>
            <div class="text-center mb-8">
                <p class="font-display font-bold text-2xl"><span class="text-terracotta">Teranga</span>Go</p>
                <p class="text-charcoal/60 text-sm mt-2">Connexion voyageur par SMS</p>
            </div>

            @if($errors->any())
                <x-ui.alert type="error" class="mb-4">{{ $errors->first() }}</x-ui.alert>
            @endif

            <x-ui.stepper :steps="['Recherche', 'Places', 'Connexion', 'Paiement', 'Billet']" :current="3" />

            <form action="{{ route('voyageur.send-otp') }}" method="POST" class="space-y-4">
                @csrf
                <x-ui.input label="Nom complet" name="name" :value="old('name')" required />
                <x-ui.input label="Numéro de téléphone" name="telephone" :value="old('telephone')" placeholder="771234567" maxlength="9" required />
                <p class="text-xs text-charcoal/50">Format sénégalais : 9 chiffres sans indicatif</p>
                <x-ui.button type="submit" class="w-full">Recevoir le code SMS</x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-public-layout>
