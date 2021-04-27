<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['approve', 'reject', 'pending']);
        return [
            'name' => Str::random(10),
            'description' => $this->faker->sentence(6),
            'photo' => Str::random(10),
            'cost' => $this->faker->randomFloat(),
            'meal_type' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner']),
            'status' => $status,
            'comment' => $status === 'reject' ? $this->faker->sentence(3) : null,
            'user_id' => 1,
        ];
    }
}
