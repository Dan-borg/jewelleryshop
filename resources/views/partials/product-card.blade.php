<div class="card h-100 shadow-sm">

    {{-- Image --}}
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
             style="height: 250px; object-fit: cover;">
    @else
        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
            <span class="text-muted">No Image</span>
        </div>
    @endif

    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="text-muted mb-1">{{ $product->category->name }}</p>

        @if ($product->stock <= 5)
            <span class="badge bg-danger mb-2">Low Stock</span>
        @endif

        <p class="fw-bold mb-3">€{{ number_format($product->price, 2) }}</p>

        <a href="{{ route('products.show', $product->id) }}" class="btn btn-blush w-100">
            View Details
        </a>
    </div>
</div>
