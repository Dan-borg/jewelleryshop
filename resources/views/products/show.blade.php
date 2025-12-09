@extends('layouts.app')

@section('content')

<style>
    .font-script {
        font-family: "Brush Script MT", "Lucida Handwriting", cursive;
    }
    .font-elegant {
        font-family: "Playfair Display", "Times New Roman", serif;
    }
    .font-minimalist {
        font-family: "Helvetica Neue", Arial, sans-serif;
        letter-spacing: 0.05em;
    }
</style>

<div class="row">
    // PRODUCT IMAGE 
    <div class="col-md-6 mb-3">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="img-fluid rounded shadow-sm">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center"
                 style="height: 300px;">
                <span class="text-muted">No Image</span>
            </div>
        @endif
    </div>

    // PRODUCT DETAILS
    <div class="col-md-6">
        <h2>{{ $product->name }}</h2>

        <p class="text-muted mb-1">
            Category: {{ $product->category->name ?? 'N/A' }}
        </p>

        @if ($product->collection)
            <p class="text-muted mb-1">Collection: {{ $product->collection->name }}</p>
        @endif

        @if ($product->stock <= 5)
            <span class="badge bg-danger mb-2">Low stock</span>
        @endif

        <p class="fs-4 fw-bold mt-2">€{{ number_format($product->price, 2) }}</p>

        @if ($product->description)
            <p class="mt-3">{{ $product->description }}</p>
        @endif

        <hr>

        // PERSONALISATION + ADD TO CART
        <h5 class="mb-3">Personalisation</h5>

        <form method="POST" action="{{ route('cart.add', $product->id) }}">
            @csrf

            @if ($product->is_engraveable)
                <p class="text-muted">
                    This piece can be engraved to make it uniquely yours.
                </p>

                {{-- ASK IF USER WANTS ENGRAVING --}}
                <div class="mb-3">
                    <label class="form-label d-block">Do you want engraving?</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="engrave"
                               id="engrave_no"
                               value="no"
                               checked>
                        <label class="form-check-label" for="engrave_no">No</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="engrave"
                               id="engrave_yes"
                               value="yes">
                        <label class="form-check-label" for="engrave_yes">Yes, engrave it</label>
                    </div>
                </div>

                // ENGRAVING FIELDS
                <div id="engravingFields" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Engraving text (max 50 characters)</label>
                        <input type="text"
                               name="engraving_text"
                               maxlength="50"
                               class="form-control"
                               placeholder="e.g. D & D · 2025">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Choose a font</label>
                        <select name="engraving_font" class="form-select">
                            <option value="">Select a font</option>
                            <option value="script">Script / Handwriting – <span class="font-script">Blush Boutique</span></option>
                            <option value="elegant">Elegant Script – <span class="font-elegant">Blush Boutique</span></option>
                            <option value="minimalist">Minimalist – <span class="font-minimalist">BLUSH BOUTIQUE</span></option>
                        </select>
                    </div>
                </div>

            @else
                // PRODUCT IS NOT ENGRAVEABLE
                <p class="text-muted">This product cannot be engraved.</p>
                <input type="hidden" name="engrave" value="no">
            @endif

            <button type="submit" class="btn btn-blush mt-3">
                Add to Cart
            </button>
        </form>

    </div>
</div>

// FOR SHOW/HIDE ENGRAVING FIELDS
<script>
document.addEventListener("DOMContentLoaded", function () {
    const yes = document.getElementById("engrave_yes");
    const no = document.getElementById("engrave_no");
    const fields = document.getElementById("engravingFields");

    if (!yes || !no || !fields) return;

    function toggle() {
        fields.style.display = yes.checked ? "block" : "none";
    }

    yes.addEventListener("change", toggle);
    no.addEventListener("change", toggle);

    toggle();
});
</script>

@endsection
