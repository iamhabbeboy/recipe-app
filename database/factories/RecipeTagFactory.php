<?php

namespace Database\Factories;

use App\Models\RecipeTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecipeTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recipe_id' => $this->faker->numberBetween(3, 10),
            'nutrition_id' => $this->faker->numberBetween(1, 10),
            'ingredient_id' => $this->faker->numberBetween(1, 10),
            'procedure_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
