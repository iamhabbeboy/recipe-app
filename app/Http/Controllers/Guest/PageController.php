<?php

namespace App\Http\Controllers\Guest;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeCollection;

class PageController extends Controller
{
    public function __invoke(\App\Repository\Recipe\RecipeRepository $recipeRepository)
    {
        $status = config('recipe.status_approve');
        $response = new RecipeCollection($recipeRepository->get($status));
        $data = [
            'recipes' => $response,
            'canLogin' => \Illuminate\Support\Facades\Route::has('login'),
            'canRegister' => \Illuminate\Support\Facades\Route::has('register'),
        ];
        return Inertia::render('Guest/Welcome', $data);
    }
}
