@extends('layouts.app')

@section('content')
<h2>Collections</h2>

<ul class="list-group">
@foreach ($collections as $collection)
    <li class="list-group-item">
        <a href="{{ route('collections.show', $collection->id) }}">
            {{ $collection->name }}
        </a>
    </li>
@endforeach
</ul>
@endsection
