@extends('layouts.app')

@section('content')
<h2>{{ $collection->name }}</h2>

<div class="row">
@forelse ($collection->products as $product)
    @include('partials.product-card')
@empty
    <p>No products in this collection.</p>
@endforelse
</div>
@endsection
