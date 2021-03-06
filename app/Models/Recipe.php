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
        'user_id',
        'comment',
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
        return $this->whereStatus('approve');
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
        return $query;
    }

    public function scopeGetByUserId($query, $userId)
    {
        return $query->whereUserId($userId);
    }

    public function scopeGetAttributes($query)
    {
        return $query->with(['ingredient', 'procedure', 'nutrition']);
    }

    public function scopePaginated($query)
    {
        return $query->paginate(config('recipe.max_per_page'));
    }

    public function nutrition()
    {
        return $this->hasMany(Nutrition::class, 'recipe_id');
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class, 'recipe_id');
    }

    public function procedure()
    {
        return $this->hasMany(Procedure::class, 'recipe_id');
    }
}
