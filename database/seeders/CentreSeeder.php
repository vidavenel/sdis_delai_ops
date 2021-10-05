<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    const CENTRES = [
        ['libelle_court' => 'AUP', 'libelle_long' => 'AUPS'],
        ['libelle_court' => 'SLS', 'libelle_long' => 'SALERNES'],
        ['libelle_court' => 'TTR', 'libelle_long' => 'TOURTOUR'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::CENTRES as $centre) {
            Centre::create($centre);
        }
    }
}
