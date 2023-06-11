<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


Route::get('/restaurant', [RestaurantController::class,'index'])->name('top');
Route::get('/restaurant/show/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::get('/restaurant/search', [RestaurantController::class, 'search'])->name('restaurant.search');
Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::get('/restaurant/form', [RestaurantController::class, 'form'])->name('restaurant.form');
Route::post('/restaurant/form/confirm', [RestaurantController::class, 'confirm'])->name('restaurant.confirm');
Route::post('/restaurant/form/upsert', [RestaurantController::class, 'upsert'])->name('restaurant.upsert');
Route::post('/restaurant/delete/{id}', [RestaurantController::class, 'delete'])->name('restaurant.delete');

Route::get('/category', [CategoryController::class,'index'])->name('category.top');
Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::Post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::Post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { 
    $userName = Auth::user()->name;
    $now = now();
    $date = $now->toDateString();
    $formattedDate = Carbon::parse($date)->format('n月j日');


    $message = '';
    if ($now->hour >= 6 && $now->hour < 12) {
        $message = 'おはようございます！今日のランチはもう決めましたか？';
    } elseif ($now->hour >= 12 && $now->hour < 18) {
        $message = 'こんにちは！今日のディナーはもう決めましたか？';
    } else {
        $message = 'こんばんは！明日のモーニングはもう決めましたか？';
    }
    return view('dashboard', [
        'user_name' => $userName,
        'date' => $formattedDate,
        'message' => $message,
    ]);

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
