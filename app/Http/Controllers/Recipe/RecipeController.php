<?php

namespace App\Http\Controllers\Recipe;

use App\Models\Recipe;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeCollection;
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
        $response = new RecipeCollection($this->recipeRepository->get());

        return Inertia::render('Recipe/Index', ['recipes' => $response]);
    }

    public function show($id)
    {
        // $response = $this->recipeRepository->find($id);
        return dd(Recipe::find(3)->tags);
        // return Inertia::render('Recipe');
    }

    public function create()
    {
        return Inertia::render('Recipe/Create');
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
