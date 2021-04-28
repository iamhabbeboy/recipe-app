<?php

namespace Database\Factories;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcedureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Procedure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'steps' . $this->faker->numberBetween(1, 10),
            'content' => $this->faker->sentence(4)
        ];
    }
}
