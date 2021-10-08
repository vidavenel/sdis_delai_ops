<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\Commune;
use Illuminate\Database\Seeder;

class DelaiSeeder extends Seeder
{
    const DELAIS = [
        'Aiguines' => [
            'AUP' => 20,
            'SLS' => 30,
            'TTR' => 25
        ],
        'Les Salles sur Verdon' => [
            'AUP' => 17,
            'SLS' => 27,
            'TTR' => 24
        ],
        'Bauduen' => [
            'AUP' => 17,
            'SLS' => 27,
            'TTR' => 24
        ],
        'Verignon' => [
            'AUP' => 12,
            'SLS' => 22,
            'TTR' => 15
        ],
        'Tourtour' => [
            'AUP' => 10,
            'SLS' => 12,
            'TTR' => 0
        ],
        'Ampus' => [
            'AUP' => 20,
            'SLS' => 22,
            'TTR' => 10
        ],
        'Villecroze' => [
            'AUP' => 10,
            'SLS' => 8,
            'TTR' => 12
        ],
        'Salernes' => [
            'AUP' => 10,
            'SLS' => 0,
            'TTR' => 15
        ],
        'Aups' => [
            'AUP' => 0,
            'SLS' => 10,
            'TTR' => 10
        ],
        'Sillans la Cascade' => [
            'AUP' => 10,
            'SLS' => 8,
            'TTR' => 20
        ],
        'Fox-Amphoux' => [
            'AUP' => 15,
            'SLS' => 10,
            'TTR' => 25
        ],
        'Montmeyan' => [
            'AUP' => 20,
            'SLS' => 30,
            'TTR' => 30
        ],
        'Regusse' => [
            'AUP' => 10,
            'SLS' => 20,
            'TTR' => 20
        ],
        'Moissac-Bellevue' => [
            'AUP' => 7,
            'SLS' => 17,
            'TTR' => 17
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_centres = Centre::all()->keyBy('libelle_court');

        foreach (self::DELAIS as $k => $DELAI) {
            /** @var Commune $_commune */
            $_commune = Commune::where('nom', $k)->firstOrFail();
            foreach ($DELAI as $_centre => $_delai) {
                $_commune->centres()->attach($_centres->get($_centre)->id, ['delai' => $_delai]);
            }
        }
    }
}
