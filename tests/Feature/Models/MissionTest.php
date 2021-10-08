<?php

namespace Tests\Feature\Models;

use App\Models\Mission;
use Database\Seeders\MissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory()
    {
        Mission::factory()->count(20)->create();
        $this->assertDatabaseCount('missions', 20);
    }

    public function testSeeder()
    {
        $this->seed(MissionSeeder::class);
        $this->assertDatabaseCount('missions', 4);
    }
}
