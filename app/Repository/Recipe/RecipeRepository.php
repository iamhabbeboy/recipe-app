<?php
namespace App\Repository\Recipe;

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
            case "reject":
                $response = $this->recipe->reject();
                break;
            case "pending":
                $response = $this->recipe->pending($userId);
            default:
                break;
        }

        return $response->getAttributes()->paginated();
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
        $status = $input['status'];
        $recipeId = $input['recipeId'];
        return $this->recipe->find($recipeId)->update(['status' => $status]);
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
        $name = $input->name;
        $description = $input->description;
        $photo = $this->getUploadPhotoPath($input->photo);
        $cost = $input->cost;
        $mealType = $input->meal_type;
        $userId = auth()->user()->id;

        // $response = $this->recipe->firstOrCreate(['name' => $name, 'user_id' => $userId], [
        //     'name' => $name,
        //     'description' => $description,
        //     'photo' => $photo,
        //     'cost' => $cost,
        //     'meal_type' => $mealType,
        //     'user_id' => $userId
        // ] );

        dd(json_decode($input->ingredient, true));
        $ingredientResponse = $this->setIngredient($input->ingredient);
    }

    private function setNutrition($nutrition)
    {
        // if(count($nutrition)) {
        //     foreach($nutrition) {

        //     }
        // }
    }

    private function setIngredient($ingredients)
    {
        $title = $ingredients['title'];
        $data = [];
        foreach($title as $key => $ingredient) {
            $data['title'] = $ingredient;
            $data['category'] = $ingredient;
        }
        dd($data);
        // \App\Models\Ingredient::create([
        //     'content' => ''
        // ]);
    }

    private function getUploadPhotoPath($photo)
    {
        $fileName = time().'.'.$photo->extension();
        $photo->move(public_path('photo'), $fileName);
        return $fileName;
    }

    public function delete($id)
    {
        return $this->recipe->find($id)->delete();
    }
}
