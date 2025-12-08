<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default homepage redirects to Shop
Route::get('/', function () {
    return redirect()->route('shop');
})->name('home');


// MAIN SHOP PAGE (search + filter + sort)
Route::get('/shop', function () {

    $search = request('search');
    $filterCategory = request('category');
    $sort = request('sort');

    $products = Product::with('category', 'collection');

    if ($search) {
        $products->where('name', 'like', '%' . $search . '%');
    }

    if ($filterCategory) {
        $products->where('category_id', $filterCategory);
    }

    // Sorting logic
    if ($sort == 'price_low_high') {
        $products->orderBy('price', 'asc');
    } elseif ($sort == 'price_high_low') {
        $products->orderBy('price', 'desc');
    } elseif ($sort == 'name_az') {
        $products->orderBy('name', 'asc');
    } elseif ($sort == 'name_za') {
        $products->orderBy('name', 'desc');
    }

    $products = $products->get();
    $categories = Category::all();

    return view('shop', compact('products', 'categories'));
})->name('shop');


// PRODUCT DETAIL PAGE
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('products.show');


// CRUD ROUTES
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);