@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height:300px;">
                <span class="text-muted">No Image</span>
            </div>
        @endif

    </div>

    <div class="col-md-6">
        <h2>{{ $product->name }}</h2>
        <p class="text-muted">{{ $product->category->name }}</p>

        <h4 class="mb-3">€{{ number_format($product->price, 2) }}</h4>

        @if ($product->stock <= 5)
            <span class="badge bg-danger">Low Stock</span>
        @endif

        <p class="mt-3">{{ $product->description }}</p>

        <a href="/" class="btn btn-secondary mt-3">Back to Shop</a>
    </div>
</div>

@endsection
