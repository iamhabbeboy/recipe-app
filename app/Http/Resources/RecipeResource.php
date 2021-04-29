<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => $this->cost,
            'photo' => $this->photo,
            'status' => $this->status,
            'comment' => $this->comment,
            'useri_id' => $this->user_id,
            'meal_type' => $this->meal_type,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'nutrition' => $this->nutrition,
            'procedure' => $this->procedure,
        ];
    }
}
