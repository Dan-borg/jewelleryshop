<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        return view('collections.index', compact('collections'));
    }

    public function show($id)
    {
        $collection = Collection::with('products')->findOrFail($id);
        return view('collections.show', compact('collection'));
    }
}
