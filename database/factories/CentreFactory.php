<?php

namespace Database\Factories;

use App\Models\Centre;
use Illuminate\Database\Eloquent\Factories\Factory;

class CentreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Centre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelle_court' => $this->faker->word,
            'libelle_long' => $this->faker->word
        ];
    }
}
