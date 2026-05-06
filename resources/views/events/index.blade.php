@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"><i class="bi bi-calendar-event me-2"></i>Events</h1>
        @can('create', App\Models\Event::class)
            <a href="{{ route('events.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Create New Event
            </a>
        @endcan
    </div>

    <div class="row g-4">
        @forelse ($events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top object-fit-cover" alt="{{ $event->name }}" style="height: 200px;">
                    @else
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center card-img-top" style="height: 200px;">
                            <i class="bi bi-image fs-1 opacity-50"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2">{{ $event->name }}</h5>

                        <div class="text-muted small mb-3">
                            <div class="mb-1"><i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y \a\t H:i') }}</div>
                            <div><i class="bi bi-geo-alt me-2"></i>{{ $event->venue->name }}</div>
                        </div>

                        <p class="card-text flex-grow-1">{{ Str::limit($event->description, 90) }}</p>

                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary btn-sm px-3">Details</a>

                            <div class="btn-group">
                                @can('update', $event)
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan

                                @can('delete', $event)
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this event?')" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center p-5">
                    <i class="bi bi-calendar-x display-1 text-muted mb-3 opacity-50"></i>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        {{-- Повідомлення для адміністратора --}}
                        <h3 class="fw-bold text-muted">No events found</h3>
                        <p class="text-muted mb-4">Your platform is currently empty. Start by creating your first event!</p>
                        <a href="{{ route('events.create') }}" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Create New Event
                        </a>
                    @else
                        {{-- Повідомлення для звичайного користувача --}}
                        <h3 class="fw-bold text-muted">No upcoming events</h3>
                        <p class="text-muted mb-0">We are preparing new exciting events for you. Please check back later!</p>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    @if($events->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $events->links() }}
        </div>
    @endif
@endsection
