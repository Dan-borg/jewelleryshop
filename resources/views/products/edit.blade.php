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
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                    @if($product->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Engraving Option --}}
    <div class="mb-3">
        <label class="form-label">Is this engravable?</label>
        <select name="is_engraveable" id="engraveableToggle" class="form-control">
            <option value="0" @if(!$product->is_engraveable) selected @endif>No</option>
            <option value="1" @if($product->is_engraveable) selected @endif>Yes</option>
        </select>
    </div>

    <div id="engravingFields" style="display: {{ $product->is_engraveable ? 'block' : 'none' }};">
        <div class="mb-3">
            <label class="form-label">Engraving Text</label>
            <input type="text" name="engraving_text" value="{{ $product->engraving_text }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Engraving Font</label>
            <select name="engraving_font" class="form-control">
                <option value="script" @if($product->engraving_font == 'script') selected @endif>
                    Elegant Script
                </option>
                <option value="minimal" @if($product->engraving_font == 'minimal') selected @endif>
                    Minimalist Sans
                </option>
            </select>
        </div>

        <div class="p-2 border rounded">
            <p class="mb-1"><strong>Font Preview:</strong></p>
            <p style="font-family: 'Brush Script MT', cursive; font-size:20px;">
                Elegant Script Example
            </p>
            <p style="font-family: Arial, sans-serif; font-size:18px;">
                Minimalist Sans Example
            </p>
        </div>
    </div>

    {{-- Image --}}
    <div class="mb-3 mt-3">
        <label class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control">
        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" width="80" class="mt-2">
        @endif
    </div>

    <button class="btn btn-primary mt-3">Update Product</button>
</form>

{{-- JS TOGGLE --}}
<script>
document.getElementById('engraveableToggle').addEventListener('change', function () {
    document.getElementById('engravingFields').style.display =
        this.value == "1" ? "block" : "none";
});
</script>

@endsection
