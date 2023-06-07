<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::get('/restaurant', [RestaurantController::class,'index'])->name('top');
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
