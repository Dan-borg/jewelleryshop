@extends('layouts.app')

@section('content')
<h2>Products</h2>

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

<table class="table table-bordered">
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price (€)</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    @foreach ($products as $product)
    <tr>
        <td>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="80">
            @endif
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name }}</td>
        <td>€{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
