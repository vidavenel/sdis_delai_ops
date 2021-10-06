<?php

namespace Tests\Feature\Models;

use App\Models\Centre;
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
}
