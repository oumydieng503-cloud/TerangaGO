<?php

namespace App\Support;

class StatusLabel
{
    public static function reservation(string $statut): array
    {
        return match ($statut) {
            'confirmee' => ['label' => 'Confirmée', 'variant' => 'success'],
            'en_attente' => ['label' => 'En attente', 'variant' => 'warning'],
            'annulee' => ['label' => 'Annulée', 'variant' => 'danger'],
            default => ['label' => ucfirst($statut), 'variant' => 'neutral'],
        };
    }

    public static function billet(string $statut): array
    {
        return match ($statut) {
            'valide' => ['label' => 'Validé', 'variant' => 'success'],
            'non_valide' => ['label' => 'En attente de validation', 'variant' => 'warning'],
            default => ['label' => ucfirst($statut), 'variant' => 'neutral'],
        };
    }
}
