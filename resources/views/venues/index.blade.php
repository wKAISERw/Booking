@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"><i class="bi bi-buildings me-2"></i>Venues</h1>
        @can('create', App\Models\Venue::class)
            <a href="{{ route('venues.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> New Venue</a>
        @endcan
    </div>

    <div class="row g-4">
        @foreach ($venues as $venue)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover overflow-hidden">
                    @if ($venue->image)
                        <img src="{{ asset('storage/' . $venue->image) }}" class="card-img-top object-fit-cover" alt="{{ $venue->name }}" style="height: 200px;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-building display-4 opacity-50"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $venue->name }}</h5>
                        <div class="d-flex align-items-start text-muted small mb-2">
                            <i class="bi bi-geo-alt-fill me-2 text-danger mt-1"></i>
                            <span>{{ $venue->address }}</span>
                        </div>
                        <div class="d-flex align-items-center text-muted small">
                            <i class="bi bi-people-fill me-2 text-primary"></i>
                            <span>Capacity: <strong>{{ number_format($venue->capacity) }}</strong></span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-3 d-flex gap-2">
                        <a href="{{ route('venues.show', $venue) }}" class="btn btn-outline-primary flex-grow-1">Details</a>

                        @can('update', $venue)
                            <a href="{{ route('venues.edit', $venue) }}" class="btn btn-light text-warning px-3" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        @endcan

                        @can('delete', $venue)
                            <form action="{{ route('venues.destroy', $venue) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light text-danger px-3" title="Delete" onclick="return confirm('Are you sure you want to delete this venue?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $venues->links() }}
    </div>
@endsection
