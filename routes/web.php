<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;






Route::resource('categories', CategoryController::class)->middleware('auth');

// Product Routes
Route::group(['middleware' => ['auth', 'role:seller|admin']], function () {
    Route::resource('product', ProductController::class);
});

 //expoert products
Route::get('products/export', [ProductController::class, 'export'])->middleware('auth', 'role:admin')->name('products.export');

//Change lang
Route::get('site/{lang}', [SiteController::class, 'ChangeLang']);

Route::get('/', function () {
    return view('welcome');
});
//pusher
Route::get('/pusher', function () {
    return view('pusher');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/shop', [SiteController::class, 'index'])->name('shop.index');

//cart

Route::get('cart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('cart', [CartController::class, 'cart'])->name('Cart');
