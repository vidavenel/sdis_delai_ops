<?php

namespace Tests\Feature\Models;

use App\Models\Centre;
use App\Models\Commune;
use Database\Seeders\CentreSeeder;
use Database\Seeders\CommuneSeeder;
use Database\Seeders\DelaiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CommuneTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testSeeder()
    {
        $this->seed(CommuneSeeder::class);
        $this->assertDatabaseCount('communes', 14);
        foreach (CommuneSeeder::COMMUNES as $COMMUNE) {
            $this->assertDatabaseHas('communes', ['nom' => $COMMUNE]);
        }
    }

    public function testFactory()
    {
        Commune::factory()->count(100)->create();
        $this->assertDatabaseCount('communes', 100);
    }

    public function test_centre_relation()
    {
        /** @var Commune $commune */
        $commune = Commune::factory()->create();
        /** @var Collection $centres */
        $centres = Centre::factory()->count(10)->create();

        $centres_ass = $centres->random(6);

        $commune->centres()->attach($centres_ass->pluck('id')->all());

        $this->assertCount(6, $commune->centres);
        $this->assertContains($centres_ass->first()->id, $commune->centres->pluck('id')->all());
        $this->assertContains($centres_ass->get(2)->id, $commune->centres->pluck('id')->all());
    }

    public function test_get_centres_ordered()
    {
        $commune = Commune::factory()->create();

        /** @var Commune $commune */
        $commune = Commune::factory()->create();
        /** @var Collection $centres */
        $centres = Centre::factory()->count(10)->create();

        foreach ($centres as $centre) {
            $commune->centres()->attach($centre, ['delai' => $this->faker->numberBetween(5, 40)]);
        }

        $centres_returned = $commune->centres;
        $this->assertCount(10, $centres_returned);
        for ($i = 0; $i < $centres_returned->count() - 1; $i++) {
            $this->assertGreaterThanOrEqual($centres_returned->get($i)->pivot->delai, $centres_returned->get($i + 1)->pivot->delai);
        }
    }

    public function test_get_centres_ordered_seeder()
    {
        $this->seed();
        /** @var Commune $commune */
        $commune = Commune::where('nom', 'Verignon')->firstOrFail();
        $commune2 = Commune::where('nom', 'Fox-Amphoux')->firstOrFail();

        $this->assertEquals(15, $commune->centres->get(1)->pivot->delai);
        $this->assertEquals('TTR', $commune->centres->get(1)->libelle_court);

        $this->assertEquals(10, $commune2->centres->get(0)->pivot->delai);
        $this->assertEquals('SLS', $commune2->centres->get(0)->libelle_court);

        $this->assertEquals(15, $commune2->centres->get(1)->pivot->delai);
        $this->assertEquals('AUP', $commune2->centres->get(1)->libelle_court);

        $this->assertEquals(25, $commune2->centres->get(2)->pivot->delai);
        $this->assertEquals('TTR', $commune2->centres->get(2)->libelle_court);
    }

    public function test_get_engins_by_missions()
    {
        $this->seed();
        /** @var Commune $commune */
        $commune = Commune::where('nom', 'Aups')->firstOrFail();

        $res = $commune->getEnginsByMission();

        $this->assertEquals('VSAV0168', ($res['SAP'][0])->no_parc);
        $this->assertEquals('VIPSR002', ($res['INC'][0])->no_parc);
    }
}
