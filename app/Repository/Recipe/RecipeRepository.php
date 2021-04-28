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
        $userId = auth()->user()->id ?? null;
        $response = $this->recipe->getByUser($userId);

        switch($status) {
            case "approve":
                $response = $this->recipe->approve();
                break;
            case "reject":
                $response = $this->recipe->reject();
                break;
            case "pending":
                $response = $this->recipe->pending($userId);
            default:
                break;
        }
        return $response->getAttributes()->paginate(config('recipe.max_per_page'));
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
     * @param array $input
     *
     * @return Collection
     */
    public function create(array $input)
    {
        return $this->recipe->firstOrCreate(['name' => $input['name']], $input);
    }

    public function delete($id)
    {
        return $this->recipe->find($id)->delete();
    }
}
