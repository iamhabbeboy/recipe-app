<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

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
    public function pending()
    {
        return $this->whereStatus('pending')->get();
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
}
