<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MetalTypeController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\MetalType;


// HOME
Route::get('/', [ProductController::class, 'shop'])->name('home');

// SHOP PAGE (search, filter, sort)
Route::get('/shop', function () {
    $search = request('search');
    $filterCategory = request('category');
    $sort = request('sort');

    $products = Product::query()->with(['category', 'collection', 'metalType']);

    // Search filter
    if ($search) {
        $products->where('name', 'LIKE', "%$search%");
    }

    // Category filter
    if ($filterCategory) {
        $products->where('category_id', $filterCategory);
    }

    // Sorting
    if ($sort == 'price_asc') {
        $products->orderBy('price', 'asc');
    } elseif ($sort == 'price_desc') {
        $products->orderBy('price', 'desc');
    }

    return view('shop', [
        'products'    => $products->get(),
        'categories'  => Category::all(),
        'collections' => Collection::all(),
        'selectedCategory' => $filterCategory,
        'selectedSort'     => $sort,
        'searchTerm'       => $search
    ]);
});

// COLLECTIONS PAGE
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');

// PRODUCTS CRUD + show
Route::resource('products', ProductController::class);

// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// CATEGORY CRUD
Route::resource('categories', CategoryController::class);

// METAL TYPES CRUD
Route::resource('metal-types', MetalTypeController::class);
