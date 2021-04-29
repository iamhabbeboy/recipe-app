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
        $userRole = auth()->check() && auth()->user()->is_admin ? true : false;
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
        $search = $input['search'];
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

    public function getAll($id = null)
    {
        return $this->recipe->getByUser($id);
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
        $recipe['photo'] = $this->getUploadPhotoPath($input->photo);
        $recipe['cost'] = $input->cost;
        $recipe['mealType'] = $input->meal_type;
        $recipe['userId'] = auth()->user()->id;

        $recipeId = $input->id;
        if($recipeId) {
            $recipeId = $this->setRecipe($recipe, $recipeId);
        }

        $this->setIngredient($input->ingredient,  $recipeId);
        // $this->setNutrition($input->nutrition, $recipe->id);
        // $this->procedure($input->instruction, $recipe->id);

        return $recipe;
    }

    private function setRecipe($input, $id)
    {
         $response = $this->recipe->updateOrCreate(['id' => $id, 'user_id' => $input['userId']], [
            'name' => $input['name'],
            'description' => $input['description'],
            'photo' => $input['photo'],
            'cost' => $input['cost'],
            'meal_type' => $input['mealType'],
            'user_id' => $input['userId']
        ]);

        return $response->id;
    }

    private function procedure($instruction, $recipeId)
    {
        $response = \App\Models\Procedure::create([
            'title' => 'steps',
            'content' => $instruction
        ]);
    }

    private function setNutrition($nutrition, $recipeId)
    {
        $nutritions = json_decode($nutrition, true);
        $model = new \App\Models\Nutrition();
    }

    private function setIngredient($ingredient, $recipeId)
    {
        $ingredients = json_decode($ingredient, true);
        dd($ingredients);
        $this->addRecipeRelationship(\App\Models\Ingredient::class, $ingredients, $recipeId);
    }

    private function addRecipeRelationship($model, $data, $recipeId)
    {
        $response = $model::whereRecipeId($recipeId);
        if($response->count()) {
            foreach($data as $key => $value) {
                $value['recipe_id'] = $recipeId;
                $a = $response->update($value);
            }
            dd("oops");
        } else {
            dd("lksjdfdf");
        }
        //  else {
        //     $data = [];
        //     foreach($data as $key => $value) {
        //        $data[] = [
        //             'content' => $value['content'],
        //             'quantity' => $value['quantity'],
        //             'category' => $value['category'],
        //             'recipe_id' => $recipeId,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now()
        //         ];
        //     }
        //     $response = $model::insert($data);
        // }
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
       return $response->paginated();
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
