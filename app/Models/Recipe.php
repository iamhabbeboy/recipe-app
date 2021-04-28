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
        return $response;
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

    public function getById($id)
    {
        return $this->whereId($id)->getAttributes()->get()->first();
    }

    public function getByUser($id)
    {
        $query = $this->whereNotNull('name')->whereNotNull('description');
        if($id) {
            $query->whereUserId($id);
        }
        return $query->with(['tags.ingredient']);
    }

    public function scopeGetByUserId($query, $userId)
    {
        return $query->whereUserId($userId);
    }

    public function scopeGetAttributes($query)
    {
        return $query->with(['tags.ingredient', 'tags.procedure', 'tags.nutrition']);
    }

    public function tags()
    {
        return $this->hasMany(RecipeTag::class, 'recipe_id');
    }
}
