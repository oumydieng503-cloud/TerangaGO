<x-panel-layout header="Validation des billets">
    @php
        $aValider = $billets->where('statut', 'non_valide')->count();
        $valides = $billets->where('statut', 'valide')->count();
    @endphp

    <div class="grid grid-cols-2 gap-4 mb-6 max-w-md">
        <x-ui.stat label="À valider" :value="$aValider" color="amber" />
        <x-ui.stat label="Validés" :value="$valides" color="forest" />
    </div>

    <x-ui.card class="mb-6">
        <h3 class="font-display font-semibold text-lg mb-4">Scanner un billet</h3>
        <div id="qr-reader" class="w-full max-w-sm mx-auto rounded-xl overflow-hidden border border-sand-200"></div>
        <p class="text-sm text-charcoal/50 text-center mt-3">Pointez la caméra vers le QR code du voyageur</p>
    </x-ui.card>

    <x-ui.card class="mb-6">
        <h3 class="font-display font-semibold text-lg mb-4">Saisie manuelle</h3>
        <form id="valider-form" action="{{ route('operateur.billets.valider') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <x-ui.input name="code_billet" id="code_billet" placeholder="Code du billet" class="flex-1" required />
            <x-ui.button type="submit">Valider</x-ui.button>
        </form>
    </x-ui.card>

    <x-ui.card :padding="false">
        <div class="p-6 border-b border-sand-200">
            <h3 class="font-display font-semibold text-lg">Billets sur mes trajets</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-charcoal/50 bg-sand-50">
                        <th class="px-6 py-3 font-medium">Code</th>
                        <th class="px-6 py-3 font-medium">Voyageur</th>
                        <th class="px-6 py-3 font-medium">Trajet</th>
                        <th class="px-6 py-3 font-medium">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sand-100">
                    @foreach($billets as $billet)
                        @php $st = \App\Support\StatusLabel::billet($billet->statut); @endphp
                        <tr class="hover:bg-sand-50/50">
                            <td class="px-6 py-3 font-mono">{{ $billet->code_billet }}</td>
                            <td class="px-6 py-3">{{ $billet->reservation->user->name }}</td>
                            <td class="px-6 py-3">{{ $billet->reservation->trajet->ligne->ville_depart }} → {{ $billet->reservation->trajet->ligne->ville_arrivee }}</td>
                            <td class="px-6 py-3"><x-ui.badge :variant="$st['variant']">{{ $st['label'] }}</x-ui.badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('valider-form');
            const codeInput = document.getElementById('code_billet');
            const html5QrCode = new Html5Qrcode('qr-reader');
            let isProcessing = false;

            html5QrCode.start(
                { facingMode: 'environment' },
                { fps: 10, qrbox: { width: 220, height: 220 } },
                function (decodedText) {
                    if (isProcessing) return;
                    isProcessing = true;
                    codeInput.value = decodedText.trim();
                    html5QrCode.stop().then(() => form.submit()).catch(() => form.submit());
                },
                function () {}
            ).catch(function (err) { console.error(err); });
        });
    </script>
</x-panel-layout>
