<?php

namespace Tests\Feature\Models;

use App\Models\Centre;
use App\Models\Engin;
use App\Models\Mission;
use Database\Seeders\CentreSeeder;
use Database\Seeders\EnginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnginTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory()
    {
        Engin::factory()->count(500)->create();
        $this->assertDatabaseCount('engins', 500);
    }

    public function test_factory_with_centre()
    {
        Engin::factory()->count(100)
            ->for(Centre::factory())
            ->create();

        $this->assertDatabaseCount('engins', 100);

        $engin = Engin::all()->random();
        $this->assertNotNull($engin->centre);
    }

    public function testSeeder()
    {
        $this->seed(CentreSeeder::class);
        $this->seed(EnginSeeder::class);
        $this->assertDatabaseCount('engins', 5);
    }

    public function test_set_one_mission_with_factory()
    {
        /** @var Engin $engin */
        $engin = Engin::factory()->create();
        /** @var Mission $mission */
        $mission = Mission::factory()->create();

        $engin->missions()->attach($mission);

        $this->assertCount(1, $engin->missions);
        $this->assertEquals($mission->id, $engin->missions->first()->id);
    }

    public function test_set_two_mission_with_factory()
    {
        /** @var Engin $engin */
        $engin = Engin::factory()->create();
        /** @var Mission $mission */
        $missions = Mission::factory()->count(2)->create();

        $engin->missions()->attach($missions->first());
        $engin->missions()->attach($missions->last());

        $this->assertCount(2, $engin->missions);

        $this->assertContains($missions->first()->id, $engin->missions->pluck('id')->all());
        $this->assertContains($missions->last()->id, $engin->missions->pluck('id')->all());
    }

    public function test_missions_relation_with_seeder()
    {
        $this->seed();

        $engin = Engin::where('no_parc', 'VIPSR002')->firstOrFail();
        $this->assertContains('SR', $engin->missions->pluck('libelle')->all());
        $this->assertContains('INC', $engin->missions->pluck('libelle')->all());

        $engin = Engin::where('no_parc', 'VIP00012')->firstOrFail();
        $this->assertNotContains('SR', $engin->missions->pluck('libelle')->all());
        $this->assertContains('INC', $engin->missions->pluck('libelle')->all());
    }
}
