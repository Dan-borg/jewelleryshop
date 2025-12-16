@extends('layouts.app')

@section('content')
<h2 class="mb-4">Add Product</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name') }}"
            required
        >
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea
            name="description"
            class="form-control"
            rows="3"
        >{{ old('description') }}</textarea>
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price (€)</label>
        <input
            type="number"
            name="price"
            step="0.01"
            class="form-control"
            value="{{ old('price') }}"
            required
        >
    </div>

    <!-- Stock -->
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input
            type="number"
            name="stock"
            class="form-control"
            value="{{ old('stock', 0) }}"
            required
        >
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @if (old('category_id') == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Collection (existing OR create new) -->
    @if (!empty($collections))
    <div class="mb-3">
        <label class="form-label">Collection (optional)</label>
        <select name="collection_id" class="form-select">
            <option value="">None</option>
            @foreach ($collections as $collection)
                <option value="{{ $collection->id }}"
                    @if (old('collection_id') == $collection->id) selected @endif>
                    {{ $collection->name }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            Or create a new collection below.
        </div>
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">New Collection Name (optional)</label>
        <input
            type="text"
            name="new_collection_name"
            class="form-control"
            value="{{ old('new_collection_name') }}"
            placeholder="e.g. Personalisation, Wedding 2025"
        >
    </div>

    <!-- Metal Type (existing OR create new) -->
    @if (!empty($metalTypes))
    <div class="mb-3">
        <label class="form-label">Metal Type (optional)</label>
        <select name="metal_type_id" class="form-select">
            <option value="">None</option>
            @foreach ($metalTypes as $metal)
                <option value="{{ $metal->id }}"
                    @if (old('metal_type_id') == $metal->id) selected @endif>
                    {{ $metal->name }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            Or create a new metal type below.
        </div>
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">New Metal Type Name (optional)</label>
        <input
            type="text"
            name="new_metal_type_name"
            class="form-control"
            value="{{ old('new_metal_type_name') }}"
            placeholder="e.g. Rose Gold, Sterling Silver"
        >
    </div>

    <!-- Engravable toggle (only marks if product CAN be engraved) -->
    <div class="mb-3">
        <label class="form-label">Is this product engravable?</label>
        <select name="is_engraveable" class="form-select">
            <option value="0" @if (old('is_engraveable', 0) == 0) selected @endif>No</option>
            <option value="1" @if (old('is_engraveable', 0) == 1) selected @endif>Yes</option>
        </select>
        <div class="form-text">
            If set to "Yes", customers will later be able to choose what to engrave and which font on the product page.
        </div>
    </div>

    <!-- Image -->
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        <div class="form-text">
            Accepted formats: jpg, jpeg, png, webp.
        </div>
    </div>

    <button class="btn btn-blush">Save Product</button>
</form>
@endsection
