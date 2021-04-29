<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeDataController extends Controller
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
     * Admin recipe approval
     *
     * @param Request $request
     *
     * @return void
     */
    public function status(Request $request)
    {
        $input = $request->validate([
            'status' => ['required'],
            'recipeId' => ['required', 'numeric']
        ]);

        return $this->recipeRepository->update($input) ? back()->with('message', 'succesfully updated') : '';
    }
    /**
     * Create recipe
     *
     * @param Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $response = $this->recipeRepository->create($request);
        return back()->with('message', 'success');
    }
}
