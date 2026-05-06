@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"><i class="bi bi-buildings me-2"></i>Venues</h1>
        @can('create', App\Models\Venue::class)
            <a href="{{ route('venues.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> New Venue
            </a>
        @endcan
    </div>

    <div class="row g-4">
        @forelse ($venues as $venue)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover overflow-hidden">
                    @if ($venue->image)
                        <img src="{{ asset('storage/' . $venue->image) }}" class="card-img-top object-fit-cover" alt="{{ $venue->name }}" style="height: 200px;">
                    @else
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-building fs-1 opacity-50"></i>
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
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center p-5">
                    <i class="bi bi-building-exclamation display-1 text-muted mb-3 opacity-50"></i>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        {{-- Повідомлення для адміністратора --}}
                        <h3 class="fw-bold text-muted">No venues created yet</h3>
                        <p class="text-muted mb-4">Before creating events, you need to add at least one venue.</p>
                        <a href="{{ route('venues.create') }}" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add Your First Venue
                        </a>
                    @else
                        {{-- Повідомлення для звичайного користувача --}}
                        <h3 class="fw-bold text-muted">No venues available</h3>
                        <p class="text-muted mb-0">Currently, there are no venues listed. Please check back later for new locations!</p>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    @if($venues->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $venues->links() }}
        </div>
    @endif
@endsection
