<?php
namespace App\Repository\Recipe;

use Carbon\Carbon;
use App\Models\Recipe;

class RecipeRepository
{
    /**
     * Recipe Model
     *
     * @var Recipe
     */
    protected Recipe $recipe;



    /**
     * Recipe instance
     *
     * @param Recipe $recipe
     *
     * @return void
     */
    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Return recipe by status
     *
     * @return void
     */
    public function get($status = null)
    {
        $userRole = (bool) auth()->check() && auth()->user()->is_admin;
        $userId = auth()->check() && !$userRole ? auth()->user()->id : null;

        $response = $this->recipe->getByUser($userId);
        switch($status) {
            case "approve":
                $response = $this->recipe->approved();
                break;
            case "pending":
                $response = $this->recipe->pending($userId);
            default:
                break;
        }

        return $response->paginated();
    }

    public function filter($query)
    {
        $input = $query->validate([
            'search' => ['required'],
            'searchBy' => []
        ]);

        return $this->search($input);
    }
    /**
     * Update recipe status
     *
     * @param array $input
     *
     * @return void
     */
    public function update(array $input)
    {
        $recipeId = $input['recipeId'];
        return $this->recipe->find($recipeId)->update($input);
    }

    public function find($id)
    {
        return $this->recipe->getById($id);
    }

    /**
     * Create new Recipe
     *
     * @param Request $input
     *
     * @return Collection
     */
    public function create($input)
    {

        $recipe = [];
        $recipe['name'] = $input->name;
        $recipe['description'] = $input->description;
        if($input->photo !== "undefined") {
            $recipe['photo'] = $this->getUploadPhotoPath($input->photo);
        }
        $recipe['cost'] = $input->cost;
        $recipe['mealType'] = $input->meal_type;
        $recipe['userId'] = auth()->user()->id;

        $recipeId = $input->id;
        if($recipeId) {
            $recipeId = $this->setRecipe($recipe, $recipeId);
        }

        self::setIngredient($input->ingredient,  $recipeId);
        self::setNutrition($input->nutrition, $recipeId);
        self::setProcedure($input->instruction, $recipeId);

        return $recipe;
    }

    private function setRecipe($input, $id)
    {
        $data = [
            'name' => $input['name'],
            'description' => $input['description'],
            'cost' => $input['cost'],
            'meal_type' => $input['mealType'],
            'user_id' => $input['userId']
        ];
        if($input['photo'] ?? null) {
            $data['photo'] = $input['photo'];
        }
         $response = $this->recipe->updateOrCreate(['id' => $id, 'user_id' => $input['userId']], $data);

        return $response->id;
    }

    private static function setProcedure($procedure, $recipeId)
    {
        $procedures = json_decode($procedure, true);
        self::addRecipeRelationship(\App\Models\Procedure::class, $procedures, $recipeId);
    }

    private static function setNutrition($nutrition, $recipeId)
    {
        $nutritions = json_decode($nutrition, true);
        self::addRecipeRelationship(\App\Models\Nutrition::class, $nutritions, $recipeId);
    }

    private static function setIngredient($ingredient, $recipeId)
    {
        $ingredients = json_decode($ingredient, true);
        self::addRecipeRelationship(\App\Models\Ingredient::class, $ingredients, $recipeId);
    }

    private static function addRecipeRelationship($model, $data, $recipeId)
    {
        $response = $model::whereRecipeId($recipeId);
        $dataCopy = [];
        foreach($data as $key => $value) {
            $value['recipe_id'] = $recipeId;
            $dataCopy[$key] = $value;
            $dataCopy[$key]['recipe_id'] = $recipeId;
            $dataCopy[$key]['created_at'] = Carbon::now();
            $dataCopy[$key]['updated_at'] = Carbon::now();
            if(!empty($value['id'])) {
                $response->whereId($value['id']);
                unset($value['id']);
                $response->update($value);
            } else {
                $model::create($value);
            }
        }
    }

    public function search($input)
    {
        $search = $input['search'];
        $searchBy = $input['searchBy'];
        $response = $this->recipe->where('name', 'like', '%'. $search . '%');
        switch($searchBy) {
            case 'meal_type':
                $response = $this->recipe->where('meal_type', 'like', '%'. $search . '%');
                break;
            case 'cost':
                $response = $this->recipe->whereCost($search);
                break;
            case 'ingredient':
                $response = $this->recipe->with(['ingredient' => function($query) use ($search) {
                    $query->where('content', 'like', '%'.$search.'%');
                }]);
                break;
            case 'nutrition':
                $response = $this->recipe->with(['nutrition' => function($query) use ($search) {
                    $query->where('content', 'like', '%'.$search.'%');
                }]);
                break;
            default:
                break;
        }
       return $response->whereStatus(config('recipe.status_approve'))->paginated();
    }

    private function getUploadPhotoPath($photo)
    {
        $fileName = time().'.'.$photo->extension();
        $photo->move(public_path('photo'), $fileName);
        return $fileName;
    }

    public function delete($id)
    {
        \App\Models\Ingredient::whereRecipeId($id)->delete();
        \App\Models\Nutrition::whereRecipeId($id)->delete();
        \App\Models\Procedure::whereRecipeId($id)->delete();
        $this->recipe->find($id)->delete();
    }

}
