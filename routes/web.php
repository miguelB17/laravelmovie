<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

Route::get('/', [MovieController::class, 'index'])->name('home');
Route::post('/', [MovieController::class, 'add_favourite'])->name('favourite');
Route::post('/search', [MovieController::class, 'find_movies'])->name('search');

Route::middleware(['auth'])->group(function() {
    Route::get('/favourites', [MovieController::class, 'show_favourites'])->name('favourites');
    
});

require __DIR__.'/auth.php';