<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RecipeSeeder::class,
            IngredientSeeder::class,
            NutritionSeeder::class,
            ProcedureSeeder::class,
            RecipeTagSeeder::class,
        ]);
    }
}
