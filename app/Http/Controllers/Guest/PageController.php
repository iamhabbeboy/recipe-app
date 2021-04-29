<?php

namespace App\Http\Controllers\Guest;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeCollection;

class PageController extends Controller
{
    /**
     * Injecting Recipe Repository
     *
     * @param RecipeRepository $recipeRepository
     *
     * @return void
     */
    public function __construct(\App\Repository\Recipe\RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }
    /**
     * Guest Landing Page
     *
     * @return Inertia
     */
    public function index()
    {
        $status = auth()->check() ? null : config('recipe.status_approve');
        $response = new RecipeCollection($this->recipeRepository->get($status));
        $data = [
            'recipes' => $response,
            'isLoggedIn' => auth()->check(),
            'canLogin' => \Illuminate\Support\Facades\Route::has('login'),
            'canRegister' => \Illuminate\Support\Facades\Route::has('register'),
        ];
        return Inertia::render('Guest/Welcome', $data);
    }
    /**
     * Show single recipe
     *
     * @param int $id
     *
     * @return void
     */
    public function show($id)
    {
        $response = new RecipeResource($this->recipeRepository->find($id));
        return Inertia::render('Guest/Single', ['recipe' => $response]);
    }
}
