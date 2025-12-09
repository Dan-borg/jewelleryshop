@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<div class="hero-blush">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h1>Blush Boutique Jewellery</h1>
            <p>
                Handcrafted pieces with a touch of romance. Discover our 2025 collections –
                from everyday elegance to personalised treasures.
            </p>
            <a href="#collection-grid" class="btn btn-blush mt-2">Browse Collection</a>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <small class="text-muted d-block">New Collection 2025</small>
            <span class="badge bg-light text-dark mt-1">Curated in Malta</span>
        </div>
    </div>
</div>

{{-- FILTERS + SORT --}}
<form method="GET" action="/" class="row g-2 mb-4">

    {{-- Search --}}
    <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="Search products...">
    </div>

    {{-- Category Filter --}}
    <div class="col-md-4">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @if (request('category') == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Sorting --}}
    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="">Sort by</option>
            <option value="price_asc"  @if (request('sort') == 'price_asc') selected @endif>Price: Low to High</option>
            <option value="price_desc" @if (request('sort') == 'price_desc') selected @endif>Price: High to Low</option>
            <option value="name_asc"   @if (request('sort') == 'name_asc') selected @endif>Name: A → Z</option>
            <option value="name_desc"  @if (request('sort') == 'name_desc') selected @endif>Name: Z → A</option>
        </select>
    </div>

    {{-- Submit --}}
    <div class="col-md-1 d-grid">
        <button class="btn btn-blush">Go</button>
    </div>
</form>

{{-- PRODUCT GRID --}}
<div id="collection-grid" class="row g-4">
    @forelse ($products as $product)
        <div class="col-md-4">
            @include('partials.product-card', ['product' => $product])
        </div>
    @empty
        <p class="text-muted">No products found matching your filters.</p>
    @endforelse
</div>

{{-- ABOUT SECTION --}}
<div class="mt-5 p-4 rounded" style="background-color:#F7E7EA;">
    <h4>About Blush Boutique Jewellery</h4>
    <p class="mb-1">
        At Blush Boutique, every piece is curated with care – from delicate everyday rings to
        statement necklaces for your most special moments.
    </p>
    <p class="mb-0">
        Soon, you’ll also be able to personalise engravable pieces, choose your favourite font style,
        and create jewellery that truly tells your story.
    </p>
</div>

@endsection
