<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_engraveable' => 'required|boolean',
            'engraving_text' => 'nullable|string|max:50',
            'engraving_font' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // External API validation (country-based font validation)
        if ($request->is_engraveable && $request->engraving_font) {

            // Call REST Countries API
            $response = Http::get("https://restcountries.com/v3.1/alpha/" . $request->engraving_font);

            if ($response->failed()) {
                return back()
                    ->withErrors(['engraving_font' => 'Invalid engraving font code (country code not found).'])
                    ->withInput();
            }
        }


        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product Added');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_engraveable' => 'required|boolean',
            'engraving_text' => 'nullable|string|max:50',
            'engraving_font' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // External API validation (country-based font validation)
        if ($request->is_engraveable && $request->engraving_font) {

            // Call REST Countries API
            $response = Http::get("https://restcountries.com/v3.1/alpha/" . $request->engraving_font);

            if ($response->failed()) {
                return back()
                    ->withErrors(['engraving_font' => 'Invalid engraving font code (country code not found).'])
                    ->withInput();
            }
        }


        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product Updated');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

}
