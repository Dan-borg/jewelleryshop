@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Metal Types</h2>
        <a href="{{ route('metal-types.create') }}" class="btn btn-blush">Add Metal Type</a>
    </div>

    @if ($metalTypes->isEmpty())
        <p class="text-muted">No metal types created yet.</p>
    @else
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($metalTypes as $metal)
                    <tr>
                        <td>{{ $metal->id }}</td>
                        <td>{{ $metal->name }}</td>
                        <td>
                            <a href="{{ route('metal-types.edit', $metal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('metal-types.destroy', $metal->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this metal type?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
