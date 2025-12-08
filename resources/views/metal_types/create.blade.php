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
            <label class="form-label">Country of Origin (validated via API)</label>
            <input type="text" name="country" class="form-control"
                   value="{{ old('country') }}"
                   placeholder="e.g. Italy, France, Spain" required>
            <div class="form-text">
                Try a wrong value like <strong>Italyyy</strong> to see the validation error,
                then try <strong>Italy</strong>.
            </div>
        </div>

        <button class="btn btn-blush">Save Metal Type</button>
    </form>
@endsection
