<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

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
            'comment' => [],
            'recipeId' => ['required', 'numeric']
        ]);

        return $this->recipeRepository->update($input) ? back()->with('message', 'succesfully updated') : '';
    }

    public function show(Request $request )
    {
        $input = $request->validate([
            'search' => ['required'],
            'searchBy' => []
        ]);
        $this->recipeRepository->search($input);
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
        // return Redirect::route('recipe.create')->with(['message' => 'Recipe added successfully!']);
    }

    public function destory($id)
    {
        $response = $this->recipeRepository->delete($id);
        return Redirect::route('dashboard.index');
    }
}
