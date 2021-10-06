<?php

namespace Tests\Feature\Models;

use App\Models\Commune;
use Database\Seeders\CommuneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommuneTest extends TestCase
{
    use RefreshDatabase;

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
}
