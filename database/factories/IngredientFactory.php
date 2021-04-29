<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->randomElement(['eggs', 'plain flour', 'salt', 'sugar', 'milk', 'fresh juice']),
            'quantity' => $this->faker->randomElement(['3', '120g', '200ml', '1 tsp', '2Tbsp']),
            'category' => $this->faker->randomElement(['main', 'primary']),
            'recipe_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
