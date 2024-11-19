@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4 shadow-sm">
                    @if ($venue->image)
                        <img src="{{ asset('storage/' . $venue->image) }}" class="card-img-top img-fluid" alt="{{ $venue->name }}" style="height: 400px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img-top img-fluid" alt="No Image" style="height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title text-center">{{ $venue->name }}</h1>
                        <p class="text-muted text-center"><strong>Address:</strong> {{ $venue->address }}</p>
                        <p class="text-muted text-center"><strong>Capacity:</strong> {{ $venue->capacity }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('venues.index') }}" class="btn btn-outline-secondary">Back to List</a>
                        @can('update', $venue)
                            <a href="{{ route('venues.edit', $venue) }}" class="btn btn-outline-warning">Edit</a>
                        @endcan
                        @can('delete', $venue)
                            <form action="{{ route('venues.destroy', $venue) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
