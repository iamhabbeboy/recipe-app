<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;

    protected $table = 'nutritions';

    protected $fillable = [
        'content',
        'value',
        'percentage',
        'recipe_id'
    ];
}
