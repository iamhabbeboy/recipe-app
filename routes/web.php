<?php

use App\Http\Controllers\Guest\PageController;
use Illuminate\Support\Facades\Route;
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

Route::prefix('recipe')->group(function () {
    Route::post('status', [App\Http\Controllers\Data\RecipeDataController::class, 'status'])->name('recipe.status');
    Route::post('create', [App\Http\Controllers\Data\RecipeDataController::class, 'create'])->name('recipe.create');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->resource('dashboard', App\Http\Controllers\Recipe\RecipeController::class);

Route::get('/', [PageController::class, 'index'])->name('guest');
Route::get('/{id}', [PageController::class, 'show'])->name('guest.show');

Route::post('/search', function (Request $request) {
    $search = $request->search;
});
