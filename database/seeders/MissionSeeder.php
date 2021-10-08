<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    const MISSIONS = [
        ['libelle' => 'SAP', 'description' => 'Mission de secours au personne'],
        ['libelle' => 'INC', 'description' => 'Incendie en milieu urbain ou industrielle'],
        ['libelle' => 'FDF', 'description' => 'Feu d\'espace naturel'],
        ['libelle' => 'SR', 'description' => 'Secours routier']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::MISSIONS as $MISSION) {
            Mission::create($MISSION);
        }
    }
}
