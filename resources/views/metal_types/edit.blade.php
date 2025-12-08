@extends('layouts.app')

@section('content')
    <h2>Edit Metal Type</h2>

    <form action="{{ route('metal-types.update', $metalType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Metal Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $metalType->name) }}" required>
        </div>

        <button class="btn btn-blush">Update Metal Type</button>
    </form>
@endsection
