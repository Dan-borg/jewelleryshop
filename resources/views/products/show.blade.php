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

    <div class="col-md-6">
        <h2>{{ $product->name }}</h2>

        <p class="text-muted mb-1">
            Category: {{ $product->category->name ?? 'N/A' }}
        </p>

        @if ($product->collection)
            <p class="text-muted mb-1">
                Collection: {{ $product->collection->name }}
            </p>
        @endif

        @if ($product->stock <= 5)
            <span class="badge bg-danger mb-2">Low stock</span>
        @endif

        <p class="fs-4 fw-bold mt-2">€{{ number_format($product->price, 2) }}</p>

        @if ($product->description)
            <p class="mt-3">{{ $product->description }}</p>
        @endif

        <hr>

        {{-- ENGRAVING + ADD TO CART --}}
        <h5 class="mb-3">Personalisation</h5>

        @if ($product->is_engraveable)
            <p class="text-muted">
                This piece can be engraved to make it uniquely yours.
            </p>

            <form method="POST" action="{{ route('products.addToCart', $product->id) }}">
                @csrf

                {{-- Choose if user wants engraving --}}
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

                <div id="engravingFields" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">What should we engrave? (max 50 characters)</label>
                        <input type="text"
                               name="engraving_text"
                               class="form-control"
                               maxlength="50"
                               placeholder="e.g. D & D · 2025">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Choose a font style</label>
                        <select name="engraving_font" class="form-select">
                            <option value="">Select font</option>
                            <option value="script">
                                Script / Handwriting – <span class="font-script">Blush Boutique</span>
                            </option>
                            <option value="elegant">
                                Elegant Script – <span class="font-elegant">Blush Boutique</span>
                            </option>
                            <option value="minimalist">
                                Minimalist – <span class="font-minimalist">BLUSH BOUTIQUE</span>
                            </option>
                        </select>
                        <small class="text-muted">
                            The preview above gives you an idea of each style.
                        </small>
                    </div>
                </div>

                <button type="submit" class="btn btn-blush mt-2">
                    Add to Cart
                </button>
            </form>
        @else
            <p class="text-muted">
                This product cannot be engraved, but it can still be added to your cart.
            </p>

            <form method="POST" action="{{ route('products.addToCart', $product->id) }}">
                @csrf
                <input type="hidden" name="engrave" value="no">
                <button type="submit" class="btn btn-blush">
                    Add to Cart
                </button>
            </form>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const yesRadio = document.getElementById('engrave_yes');
    const noRadio = document.getElementById('engrave_no');
    const fields = document.getElementById('engravingFields');

    if (yesRadio && noRadio && fields) {
        function updateVisibility() {
            fields.style.display = yesRadio.checked ? 'block' : 'none';
        }

        yesRadio.addEventListener('change', updateVisibility);
        noRadio.addEventListener('change', updateVisibility);

        updateVisibility();
    }
});
</script>

@endsection
