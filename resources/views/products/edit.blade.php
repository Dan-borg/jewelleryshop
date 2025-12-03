@extends('layouts.app')

@section('content')
<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (€)</label>
        <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Current Image</label><br>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="120">
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label">Change Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">Update</button>
</form>
@endsection
