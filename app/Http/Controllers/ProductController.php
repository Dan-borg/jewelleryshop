<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\MetalType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show all products (admin list).
     */
    public function index()
    {
        $products = Product::with(['category', 'collection', 'metalType'])->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show create product form.
     */
    public function create()
    {
        $categories   = Category::all();
        $collections  = Collection::all();
        $metalTypes   = MetalType::all();

        return view('products.create', compact('categories', 'collections', 'metalTypes'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category_id'       => 'required|exists:categories,id',

            // existing / new collection
            'collection_id'       => 'nullable|exists:collections,id',
            'new_collection_name' => 'nullable|string|max:255',

            // existing / new metal type
            'metal_type_id'        => 'nullable|exists:metal_types,id',
            'new_metal_type_name'  => 'nullable|string|max:255',

            // engravable options
            'is_engraveable'    => 'required|boolean',
            'engraving_text'    => 'nullable|string|max:50',
            'engraving_font'    => 'nullable|string|max:50',

            // image
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Handle create-on-the-fly collection
        $collectionId = $request->collection_id;
        if ($request->filled('new_collection_name')) {
            $collection = Collection::create([
                'name' => $request->new_collection_name,
            ]);
            $collectionId = $collection->id;
        }

        // Handle create-on-the-fly metal type
        $metalTypeId = $request->metal_type_id;
        if ($request->filled('new_metal_type_name')) {
            $metal = MetalType::create([
                'name' => $request->new_metal_type_name,
            ]);
            $metalTypeId = $metal->id;
        }

        // Build data array (exclude helper fields)
        $data = $request->except(['image', 'new_collection_name', 'new_metal_type_name']);

        $data['collection_id']  = $collectionId;
        $data['metal_type_id']  = $metalTypeId;
        $data['is_engraveable'] = (bool) $request->is_engraveable;

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Show edit form for a product.
     */
    public function edit(Product $product)
    {
        $categories   = Category::all();
        $collections  = Collection::all();
        $metalTypes   = MetalType::all();

        return view('products.edit', compact('product', 'categories', 'collections', 'metalTypes'));
    }

    /**
     * Update existing product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category_id'       => 'required|exists:categories,id',

            'collection_id'       => 'nullable|exists:collections,id',
            'new_collection_name' => 'nullable|string|max:255',

            'metal_type_id'        => 'nullable|exists:metal_types,id',
            'new_metal_type_name'  => 'nullable|string|max:255',

            'is_engraveable'    => 'required|boolean',
            'engraving_text'    => 'nullable|string|max:50',
            'engraving_font'    => 'nullable|string|max:50',

            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Handle create-on-the-fly collection
        $collectionId = $request->collection_id;
        if ($request->filled('new_collection_name')) {
            $collection = Collection::create([
                'name' => $request->new_collection_name,
            ]);
            $collectionId = $collection->id;
        }

        // Handle create-on-the-fly metal type
        $metalTypeId = $request->metal_type_id;
        if ($request->filled('new_metal_type_name')) {
            $metal = MetalType::create([
                'name' => $request->new_metal_type_name,
            ]);
            $metalTypeId = $metal->id;
        }

        $data = $request->except(['image', 'new_collection_name', 'new_metal_type_name']);

        $data['collection_id']  = $collectionId;
        $data['metal_type_id']  = $metalTypeId;
        $data['is_engraveable'] = (bool) $request->is_engraveable;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Delete product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Public product details page.
     */
    public function show($id)
    {
        $product = Product::with(['category', 'collection', 'metalType'])->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
