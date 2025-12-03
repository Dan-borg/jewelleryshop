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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

