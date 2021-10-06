<?php

namespace Database\Seeders;

use App\Models\Commune;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    const COMMUNES = [
        'Aiguines',
        'Les Salles sur Verdon',
        'Bauduen',
        'Verignon',
        'Tourtour',
        'Ampus',
        'Villecroze',
        'Salernes',
        'Aups',
        'Sillans la Cascade',
        'Fox-Amphoux',
        'Montmeyan',
        'Regusse',
        'Moissac-Bellevue'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::COMMUNES as $COMMUNE) {
            Commune::create(['nom' => $COMMUNE]);
        }
    }
}
