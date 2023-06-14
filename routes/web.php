<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HotpepperController;



// ログイン前　ウェルカムページ表示
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HotpepperController::class,'index'])->name('dashboard');
    

    // 店舗関連ページ
    Route::get('/restaurant', [RestaurantController::class,'index'])->name('top');
    Route::get('/restaurant/show/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::get('/restaurant/search', [RestaurantController::class, 'search'])->name('restaurant.search');
    Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
    Route::get('/restaurant/form', [RestaurantController::class, 'form'])->name('restaurant.form');
    Route::post('/restaurant/form/confirm', [RestaurantController::class, 'confirm'])->name('restaurant.confirm');
    Route::post('/restaurant/form/upsert', [RestaurantController::class, 'upsert'])->name('restaurant.upsert');
    Route::post('/restaurant/delete/{id}', [RestaurantController::class, 'delete'])->name('restaurant.delete');

    // カテゴリー関連ページ
    Route::get('/category', [CategoryController::class,'index'])->name('category.top');
    Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::Post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::Post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // タイムアウト後のリダイレクト設定
    Route::get('/timeout', function () {
        return redirect()->route('welcome');
    })->name('timeout');
});

require __DIR__.'/auth.php';
