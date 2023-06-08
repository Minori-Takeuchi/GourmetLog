<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::get('/restaurant', [RestaurantController::class,'index'])->name('top');
Route::get('/restaurant/show/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::get('/restaurant/search', [RestaurantController::class, 'search'])->name('restaurant.search');
Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::get('/restaurant/form', [RestaurantController::class, 'form'])->name('restaurant.form');
Route::get('/restaurant/form/confirm', [RestaurantController::class, 'confirm'])->name('restaurant.confirm');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
