<?php

namespace App\Http\Controllers\Guest;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeCollection;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    public function index(Request $request)
    {
        $status = auth()->check() ? null : config('recipe.status_approve');
        $payload = $request->search ? $this->recipeRepository->filter($request) : $this->recipeRepository->get($status);
        $response = new RecipeCollection($payload);

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

    public function verifyUser()
    {
        return Inertia::render('Auth/VerifyEmail');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/home');
    }

    public function verificationNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
