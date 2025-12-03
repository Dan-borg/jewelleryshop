@extends('layouts.app')

@section('content')
<h2>Edit Category</h2>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>

    <button class="btn btn-success">Update</button>
</form>
@endsection
