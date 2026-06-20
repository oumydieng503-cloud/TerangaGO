<?php

namespace App\Services;

class PaymentService
{
    /**
     * Traite un paiement.
     *
     * Pour l'instant, cette méthode SIMULE un paiement réussi.
     * Plus tard, on pourra remplacer ce contenu par un vrai appel API
     * vers Wave, Orange Money, ou un autre fournisseur, sans changer
     * le reste de l'application (le contrat de la méthode reste le même).
     *
     * @param float $montant Le montant à payer
     * @param string $telephone Le numéro de téléphone du payeur
     * @return array ['success' => bool, 'reference' => string|null, 'message' => string]
     */
    public function payer(float $montant, string $telephone): array
    {
        // --- SIMULATION ---
        // Dans une vraie intégration Wave, on ferait ici un appel HTTP
        // vers l'API Wave avec le montant et le téléphone, puis on
        // attendrait la confirmation du paiement.

        $referenceSimulee = 'SIM-' . strtoupper(uniqid());

        return [
            'success'   => true,
            'reference' => $referenceSimulee,
            'message'   => 'Paiement simulé effectué avec succès.',
        ];

        // --- FUTUR EXEMPLE AVEC VRAIE API (commenté) ---
        // $response = Http::withToken(config('services.wave.api_key'))
        //     ->post('https://api.wave.com/v1/checkout', [
        //         'amount' => $montant,
        //         'phone' => $telephone,
        //     ]);
        //
        // return [
        //     'success' => $response->successful(),
        //     'reference' => $response->json('id'),
        //     'message' => $response->json('message'),
        // ];
    }
}