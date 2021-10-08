<?php

namespace Database\Factories;

use App\Models\Engin;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnginFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Engin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_parc' => $this->generateNoparc()
        ];
    }

    private function generateNoparc()
    {
        $_type = $this->faker->randomElement(['VSAV', 'VIP', 'VIPSR', 'FPT', 'FPTL', 'FPTSR']);
        $_no = $this->faker->unique()->numberBetween(0, 999);
        $_no_length = 8 - strlen($_type);
        return $_type . str_pad($_no, $_no_length, '0', STR_PAD_LEFT);
    }
}
