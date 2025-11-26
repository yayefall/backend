<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehiculeAppSeeder extends Seeder
{
    public function run(): void
    {
        // Chauffeurs
        $drivers =
        [
            ['nom' => 'Ndiaye',
            'prenom' => 'Mamadou',
            'telephone' => '771234567',
            'permis' => 'B12345',
            'created_at' => now(),
            'updated_at' => now(),
            ],

            ['nom' => 'Ba',
            'prenom' => 'Aminata',
            'telephone' => '781112233',
            'permis' => 'B67890',
            'created_at' => now(),
            'updated_at' => now(),
            ],

            ['nom' => 'Diop',
             'prenom' => 'Cheikh',
             'telephone' => '761998877',
             'permis' => 'B11223',
             'created_at' => now(),
             'updated_at' => now(),
          ],
    ];

        DB::table('drivers')->insert($drivers);

        // Véhicules
        $vehicules = [
            [
                'immatriculation' => 'DK-1234-AA',
                'marque' => 'Toyota',
                'modele' => 'Corolla',
                'annee' => 2020,
                'couleur' => 'Gris',
                'driver_id' => 1,
                'statut' => 'actif',
                'remarques' => 'Utilisé pour les trajets internes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'immatriculation' => 'DK-5678-BB',
                'marque' => 'Peugeot',
                'modele' => '308',
                'annee' => 2021,
                'couleur' => 'Bleu',
                'driver_id' => 2,
                'statut' => 'actif',
                'remarques' => 'En très bon état',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'immatriculation' => 'DK-9012-CC',
                'marque' => 'Hyundai',
                'modele' => 'Tucson',
                'annee' => 2019,
                'couleur' => 'Blanc',
                'driver_id' => 3,
                'statut' => 'en_entretien',
                'remarques' => 'Freins à remplacer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('vehicules')->insert($vehicules);

        // Lavages (2 fois par semaine pour chaque véhicule)
        $lavages = [];
        $now = Carbon::now();

        foreach (range(1, 3) as $vehicule_id) {
            for ($i = 0; $i < 4; $i++) {
                $lavages[] = [
                    'vehicule_id' => $vehicule_id,
                    'date_lavage' => $now->copy()->subDays($i * 3),
                    'type' => 'standard',
                    'effectué_par' => 'Service Lavage',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('lavages')->insert($lavages);

        // Entretiens
        $entretiens = [
            [
                'vehicule_id' => 1,
                'date_entretien' => Carbon::now()->subWeeks(2),
                'type' => 'Vidange',
                'remarques' => 'Changement d’huile moteur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vehicule_id' => 2,
                'date_entretien' => Carbon::now()->subMonth(),
                'type' => 'Freins',
                'remarques' => 'Remplacement des plaquettes de freins',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vehicule_id' => 3,
                'date_entretien' => Carbon::now()->subDays(10),
                'type' => 'Pneus',
                'remarques' => 'Changement des pneus avant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('entretiens')->insert($entretiens);
    }
}
