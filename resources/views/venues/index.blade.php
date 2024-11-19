@extends('layouts.app')

@section('content')
    <h1>Venues</h1>

    @can('create', App\Models\Venue::class)
        <a href="{{ route('venues.create') }}" class="btn btn-primary mb-3">Create New Venue</a>
    @endcan

    <div class="container">
        <div class="row">
            @foreach ($venues as $venue)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($venue->image)
                            <img src="{{ asset('storage/' . $venue->image) }}" class="card-img-top img-fluid" alt="{{ $venue->name }}" style="object-fit: cover; height: 200px;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" alt="No Image" style="object-fit: cover; height: 200px;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $venue->name }}</h5>
                            <p>{{ $venue->address }}</p>
                            <p><strong>Capacity:</strong> {{ $venue->capacity }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('venues.show', $venue) }}" class="btn btn-primary btn-sm">View Details</a>
                            @can('update', $venue)
                                <a href="{{ route('venues.edit', $venue) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('delete', $venue)
                            <form action="{{ route('venues.destroy', $venue) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $venues->links() }}
    </div>
@endsection
