@extends('layouts.app')

@section('content')
<h2>Your Cart</h2>

@if (empty($cart))
    <p>Your cart is empty.</p>
@else
    <table class="table">
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th></th>
        </tr>

        @foreach ($cart as $id => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>€{{ number_format($item['price'], 2) }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                        @csrf
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endif
@endsection
