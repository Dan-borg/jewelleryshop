@extends('layouts.app')

@section('content')
<h2>Add Product</h2>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (€)</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- ENGRAVING OPTION --}}
    <div class="mb-3">
        <label class="form-label">Is this engravable?</label>
        <select name="is_engraveable" id="engraveableToggle" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>

    <div id="engravingFields" style="display:none">
        <div class="mb-3">
            <label class="form-label">Engraving Text</label>
            <input type="text" name="engraving_text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Engraving Font</label>
            <select name="engraving_font" class="form-control">
                <option value="script">Elegant Script</option>
                <option value="minimal">Minimalist Sans</option>
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

    <div class="mb-3 mt-3">
        <label class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success mt-3">Save Product</button>
</form>

{{-- JS TOGGLE --}}
<script>
document.getElementById('engraveableToggle').addEventListener('change', function () {
    document.getElementById('engravingFields').style.display =
        this.value == "1" ? "block" : "none";
});
</script>

@endsection
