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

        @if ($product->is_engraveable)
        <div class="mt-3 p-3 rounded" style="background-color:#F7E7EA;">
            <h5 class="mb-1">Personalisation</h5>
            <p class="mb-1"><strong>Engraving Text:</strong> {{ $product->engraving_text }}</p>
            <p class="mb-0"><strong>Font:</strong>
                @if ($product->engraving_font == 'script')
                    <span style="font-family:cursive;">{{ $product->engraving_text }}</span>
                @elseif ($product->engraving_font == 'elegant')
                    <span style="font-family: 'Segoe Script', cursive; font-size:1.2rem;">
                        {{ $product->engraving_text }}
                    </span>
                @else
                    <span style="font-family: sans-serif; font-weight:300;">
                        {{ $product->engraving_text }}
                    </span>
                @endif
            </p>
        </div>
        @endif


        <a href="/" class="btn btn-secondary mt-3">Back to Shop</a>
    </div>
</div>

@endsection
