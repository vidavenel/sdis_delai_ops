<?php

namespace Tests\Feature\Models;

use App\Models\Centre;
use App\Models\Mission;
use Database\Seeders\CentreSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CentreTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder()
    {
        $this->seed(CentreSeeder::class);
        $this->assertDatabaseCount('centres', 3);
        foreach (CentreSeeder::CENTRES as $CENTRE) {
            $this->assertDatabaseHas('centres', $CENTRE);
        }
    }

    public function test_factory()
    {
        Centre::factory()->count(80)->create();
        $this->assertDatabaseCount('centres', 80);
    }

    public function test_getEnginsHasMission_function()
    {
        $this->seed();
        $mission = Mission::where('libelle', 'SAP')->firstOrFail();
        /** @var Centre $centre */
        $centre = Centre::where('libelle_court', 'AUP')->firstOrFail();

        $this->assertEquals('VSAV0168', $centre->getEnginsHasMission($mission)->first()->no_parc);
    }
}
