<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
    use HasFactory;

    protected $table = 'recipe_tags';

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    public function nutrition()
    {
        return $this->belongsTo(Nutrition::class);
    }


}
