<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('producten')->insert(
            [
                [
                    'naam' => 'Appel',
                    'actuele_prijs' => 0.5,
                    'afbeeldingen' => 'assets/images/items/appel.png',
                    'organisatie_id' => 1,
                    'categorie_id' => 1,

                    'standaard_id' => null,

                    'positie' => 1,
                    'voorraad' => 20,
                    'voorraadAanvullen' => true
                ],
                [
                    'naam' => 'Kaartje',
                    'actuele_prijs' => 1,
                    'afbeeldingen' => 'assets/images/items/kaartje.png',
                    'organisatie_id' => 2,
                    'categorie_id' => 2,

                    'standaard_id' => null,
                    'positie' => 1,

                    'voorraad' => 5,
                    'voorraadAanvullen' => false
                ],
                [
                    'naam' => 'Koek',
                    'actuele_prijs' => 1.5,
                    'afbeeldingen' => 'assets/images/items/koekje.png',
                    'organisatie_id' => 2,
                    'categorie_id' => 1,
                    'standaard_id' => null,
                    'positie' => 2,
                    'voorraad' => 25,
                    'voorraadAanvullen' => true
                ]
            ]
        );
    }
}
