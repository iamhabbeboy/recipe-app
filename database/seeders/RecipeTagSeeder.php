<?php

namespace Database\Seeders;

use App\Models\RecipeTag;
use Illuminate\Database\Seeder;

class RecipeTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeTag::factory()
            ->count(20)
            ->create();
    }
}
