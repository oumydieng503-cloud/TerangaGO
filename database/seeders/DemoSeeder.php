<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Ligne;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@terangago.sn'],
            ['name' => 'Administrateur', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $operateur = User::firstOrCreate(
            ['email' => 'operateur@demdikk.sn'],
            ['name' => 'Dem Dikk Transport', 'password' => Hash::make('password'), 'role' => 'operateur']
        );

        $voyageur = User::firstOrCreate(
            ['telephone' => '771234567'],
            ['name' => 'Aminata Diop', 'email' => 'aminata@example.com', 'password' => Hash::make('password'), 'role' => 'voyageur']
        );

        $lignes = [
            ['nom' => 'Dakar - Thiès', 'ville_depart' => 'Dakar', 'ville_arrivee' => 'Thiès'],
            ['nom' => 'Dakar - Saint-Louis', 'ville_depart' => 'Dakar', 'ville_arrivee' => 'Saint-Louis'],
            ['nom' => 'Dakar - Touba', 'ville_depart' => 'Dakar', 'ville_arrivee' => 'Touba'],
            ['nom' => 'Dakar - Ziguinchor', 'ville_depart' => 'Dakar', 'ville_arrivee' => 'Ziguinchor'],
        ];

        foreach ($lignes as $data) {
            Ligne::firstOrCreate(['nom' => $data['nom']], $data);
        }

        $bus = Bus::firstOrCreate(
            ['numero' => 'DK-204'],
            ['capacite' => 50, 'operateur_id' => $operateur->id]
        );

        Bus::firstOrCreate(
            ['numero' => 'DK-118'],
            ['capacite' => 45, 'operateur_id' => $operateur->id]
        );

        $trajets = [
            ['ligne' => 'Dakar - Thiès', 'prix' => 2500, 'heure' => '07:00', 'places' => 35],
            ['ligne' => 'Dakar - Thiès', 'prix' => 2500, 'heure' => '14:30', 'places' => 40],
            ['ligne' => 'Dakar - Saint-Louis', 'prix' => 5000, 'heure' => '06:00', 'places' => 28],
            ['ligne' => 'Dakar - Touba', 'prix' => 3500, 'heure' => '08:00', 'places' => 42],
        ];

        foreach ($trajets as $t) {
            $ligne = Ligne::where('nom', $t['ligne'])->first();
            Trajet::firstOrCreate(
                [
                    'ligne_id' => $ligne->id,
                    'bus_id' => $bus->id,
                    'date_depart' => now()->addDays(2)->toDateString(),
                    'heure_depart' => $t['heure'],
                ],
                ['prix' => $t['prix'], 'places_dispo' => $t['places']]
            );
        }

        Trajet::firstOrCreate(
            [
                'ligne_id' => Ligne::where('nom', 'Dakar - Thiès')->first()->id,
                'bus_id' => $bus->id,
                'date_depart' => now()->toDateString(),
                'heure_depart' => '18:00',
            ],
            ['prix' => 2500, 'places_dispo' => 20]
        );
    }
}
