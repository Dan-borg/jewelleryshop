@extends('layouts.app')

@section('content')
<h2>Your Cart</h2>

@if(empty($cart))
    <p>Your cart is empty.</p>
    <a href="/shop" class="btn btn-blush">Continue Shopping</a>
@else
    @foreach($cart as $id => $item)
        <div class="card mb-3 p-3">
            <div class="d-flex align-items-center gap-3">

                {{-- IMAGE --}}
                @if($item['image'])
                    <img src="{{ asset('storage/' . $item['image']) }}"
                         alt=""
                         style="width:80px; height:80px; object-fit:cover; border-radius:10px;">
                @endif

                <div class="flex-grow-1">
                    <strong>{{ $item['name'] }}</strong><br>
                    €{{ number_format($item['price'], 2) }}<br>
                    Quantity: {{ $item['quantity'] }}
                </div>

                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Remove</button>
                </form>

            </div>
        </div>
    @endforeach

    <a href="/shop" class="btn btn-blush mt-3">Continue Shopping</a>
@endif
@endsection
