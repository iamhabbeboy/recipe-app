<?php

namespace App\Http\Controllers\Recipe;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeCollection;
use Illuminate\Support\Facades\Redirect;
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
        return Inertia::render('Recipe/Index', ['recipes' => $response, 'isLoggedIn' => auth()->check(), 'isAdmin' => auth()->user()->is_admin]);
    }

    public function show($id)
    {
        $response = new RecipeResource($this->recipeRepository->find($id));
        return Inertia::render('Recipe/Single', ['recipe' => $response, 'isLoggedIn' => auth()->check(), 'isUser' => auth()->user()->is_admin]);
    }

    public function create()
    {
        return Inertia::render('Recipe/Create');
    }

    public function edit($id)
    {
        // $response = \App\Models\Recipe::find($id)->with(['tags'])->get()->first();
        $response = new RecipeResource($this->recipeRepository->find($id));
        return Inertia::render('Recipe/Create', ['recipe' => $response]);
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
        $this->recipeRepository->create($input);
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
