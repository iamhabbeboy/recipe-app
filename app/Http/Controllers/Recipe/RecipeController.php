<?php

namespace App\Http\Controllers\Recipe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Repository\Recipe\RecipeRepository;

class RecipeController extends Controller
{
    /**
     * The recipe Repository
     *
     * @var RecipeRepository
     */
    protected RecipeRepository $recipeRepository;

    /**
     * Injecting Recipe Repository
     *
     * @param RecipeRepository $recipeRepository
     *
     * @return void
     */
    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }
    /**
     * Get / filter recipes
     *
     * @return void
     */
    public function index()
    {
        return new RecipeResource($this->recipeRepository->get());
    }

    /**
     * Validate and create new recipe
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        return new RecipeResource($this->recipeRepository->create($input));
    }

    /**
     * Delete recipe
     *
     * @param [type] $id
     *
     * @return void
     */
    public function destroy($id)
    {
        return (bool) $this->recipeRepository->delete($id);
    }
}
