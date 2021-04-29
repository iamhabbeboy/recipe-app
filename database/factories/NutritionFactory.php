<?php

namespace Database\Factories;

use App\Models\Nutrition;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nutrition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => Str::random(8),
            'value' => $this->faker->numberBetween(10, 50) . $this->faker->randomElement(['kcal', 'g', 'mg']),
            'percentage' => $this->faker->numberBetween(2, 90) . '%',
            'recipe_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
