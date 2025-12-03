<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;

// HOME / SHOP PAGE
Route::get('/', function () {
    $search = request('search');
    $filterCategory = request('category');

    $products = Product::with('category');

    if ($search) {
        $products->where('name', 'like', '%' . $search . '%');
    }

    if ($filterCategory) {
        $products->where('category_id', $filterCategory);
    }

    $products = $products->get();
    $categories = Category::all();

    return view('shop', compact('products', 'categories'));
});

// CATEGORY CRUD ROUTES
Route::resource('categories', CategoryController::class);

// PRODUCT CRUD ROUTES
Route::resource('products', ProductController::class);

// PRODUCT DETAILS PAGE
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
