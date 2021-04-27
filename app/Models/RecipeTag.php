<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
    use HasFactory;

    protected $table = 'recipe_tags';

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
