@extends('layouts.app')

@section('content')

<h2 class="mb-4">Our Jewellery Collection</h2>

<!-- Search + Filter -->
<form method="GET" action="/" class="row mb-4">

    <!-- Search Bar -->
    <div class="col-md-6 mb-2">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" placeholder="Search products...">
    </div>

    <!-- Category Filter -->
    <div class="col-md-4 mb-2">
        <select name="category" class="form-control">
            <option value="">All Categories</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @if (request('category') == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit -->
    <div class="col-md-2 mb-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

</form>

<!-- Product Grid -->
<div class="row">
    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">

            <!-- Image -->
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:250px;object-fit:cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:250px;">
                    <span class="text-muted">No Image</span>
                </div>
            @endif

            <div class="card-body">

                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="text-muted">{{ $product->category->name }}</p>

                <!-- Low Stock Badge -->
                @if ($product->stock <= 5)
                    <span class="badge bg-danger mb-2">Low Stock</span>
                @endif

                <p class="fw-bold mb-2">€{{ number_format($product->price, 2) }}</p>

                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark w-100">
                    View Details
                </a>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
