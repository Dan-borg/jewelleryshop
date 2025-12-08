<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetalTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;

Route::get('/', function () {
    $search = request('search');
    $filterCategory = request('category');
    $sort = request('sort');

    $products = Product::with('category');

    if ($search) {
        $products->where('name', 'like', '%' . $search . '%');
    }

    if ($filterCategory) {
        $products->where('category_id', $filterCategory);
    }

    switch ($sort) {
        case 'price_asc':
            $products->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $products->orderBy('price', 'desc');
            break;
        case 'name_asc':
            $products->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $products->orderBy('name', 'desc');
            break;
        default:
            $products->orderBy('created_at', 'desc');
            break;
    }

    $products = $products->get();
    $categories = Category::all();

    return view('shop', compact('products', 'categories'));
});

// Category CRUD
Route::resource('categories', CategoryController::class);

// Product CRUD
Route::resource('products', ProductController::class);

// ⭐ Add to Cart (customer side)
Route::post('/products/{product}/add-to-cart', [ProductController::class, 'addToCart'])
    ->name('products.addToCart');

Route::post('/metaltypes/ajax-create', [App\Http\Controllers\MetalTypeController::class, 'ajaxStore'])
    ->name('metaltypes.store.ajax');

Route::resource('metal-types', MetalTypeController::class);

