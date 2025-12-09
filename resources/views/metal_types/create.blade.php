@extends('layouts.app')

@section('content')
    <h2>Add Metal Type</h2>

    <form action="{{ route('metal-types.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Metal Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Country of Origin</label>
            <input type="text" name="country" class="form-control" placeholder="e.g. Italy" required>

            @error('country')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>


        <button class="btn btn-blush">Save Metal Type</button>
    </form>
@endsection
