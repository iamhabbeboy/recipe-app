<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    /**
     * Important keys
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cost',
        'photo',
        'status',
        'meal_type',
        'description',
    ];

    /**
     * Return pending recipes
     *
     * @return Collection
     */
    public function pending($userId = null)
    {
        $response = $this->whereStatus('pending');
        if($userId) {
            $response->getByUserId($userId);
        }
        return $response->with('tags')->get();
    }

    /**
     * Return approved recipes
     *
     * @return Collection
     */
    public function approved()
    {
        return $this->whereStatus('approve')->get();
    }

    /**
     * Return rejected recipes
     *
     * @return void
     */
    public function reject()
    {
        return $this->whereStatus('reject')->get();
    }

    public function scopeGetByUserId($query, $userId)
    {
        return $query->whereUserId($userId);
    }

    public function getById($id)
    {
        return $this->whereId(3)->get();
    }

    public function tags()
    {
        return $this->hasMany(RecipeTag::class, 'recipe_id');
    }
}
