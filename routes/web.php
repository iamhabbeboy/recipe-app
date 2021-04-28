<?php

use App\Http\Controllers\Guest\PageController;
use Inertia\Inertia;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', PageController::class);

Route::post('/search', function (Request $request) {
    $search = $request->search;

});

Route::middleware(['auth:sanctum', 'verified'])
    ->resource('dashboard', App\Http\Controllers\Recipe\RecipeController::class);

