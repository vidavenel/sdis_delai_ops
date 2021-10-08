<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Mission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CentreSeeder::class);
        $this->call(CommuneSeeder::class);
        $this->call(MissionSeeder::class);
        $this->call(EnginSeeder::class);
        $this->call(DelaiSeeder::class);
    }
}
