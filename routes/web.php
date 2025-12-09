<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MetalTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home redirects to shop
Route::get('/', [ProductController::class, 'shop'])->name('shop');

// SHOP page
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// COLLECTIONS
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{id}', [CollectionController::class, 'show'])->name('collections.show');

// Category CRUD
Route::resource('categories', CategoryController::class);

// PRODUCTS CRUD
Route::resource('products', ProductController::class);

// METAL TYPES CRUD
Route::resource('metal-types', MetalTypeController::class);

// CART
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
