@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Available Tickets</h1>
    </div>

    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 80px; z-index: 1;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="bi bi-funnel me-2"></i>Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('tickets.index') }}">
                        <div class="mb-3">
                            <label for="search" class="form-label text-muted small fw-bold text-uppercase">Search</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" id="search" class="form-control border-start-0 ps-0" placeholder="Ticket name..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Price Range</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="min_price" class="form-control" placeholder="Min $" value="{{ request('min_price') }}">
                                <input type="number" name="max_price" class="form-control" placeholder="Max $" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Events</label>
                            <div class="border rounded p-3 bg-light" style="max-height: 200px; overflow-y: auto;">
                                @foreach($events as $event)
                                    <div class="form-check mb-2">
                                        <label class="form-check-label" for="event_{{ $event->id }}">
                                            <input class="form-check-input" type="checkbox" name="event_id[]" id="event_{{ $event->id }}" value="{{ $event->id }}" {{ in_array($event->id, (array) request('event_id', [])) ? 'checked' : '' }}>
                                            {{ $event->name }} <span class="badge bg-secondary rounded-pill">{{ $event->tickets_count }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="sort" class="form-label text-muted small fw-bold text-uppercase">Sort By</label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Default</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        @if(request()->anyFilled(['search', 'min_price', 'max_price', 'event_id', 'sort']))
                            <a href="{{ route('tickets.index') }}" class="btn btn-link text-decoration-none w-100 mt-2 text-muted">Clear Filters</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse ($tickets as $ticket)
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 border-0 shadow-sm card-hover overflow-hidden">
                            <div class="position-relative">
                                @if ($ticket->event->image)
                                    <img src="{{ asset('storage/' . $ticket->event->image) }}" alt="{{ $ticket->event->name }}" class="card-img-top object-fit-cover" style="height: 180px;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                                        <i class="bi bi-image fs-1 opacity-50"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary fs-6 shadow-sm">${{ number_format($ticket->price, 2) }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-truncate mb-1">{{ $ticket->type }}</h5>
                                <p class="text-primary small fw-semibold mb-3">{{ $ticket->event->name }}</p>

                                <div class="d-flex align-items-center text-muted small mb-2">
                                    <i class="bi bi-calendar3 me-2"></i> {{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y H:i') }}
                                </div>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="bi bi-ticket-fill me-2"></i> {{ $ticket->quantity }} available
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex gap-2 p-3">
                                <a href="{{ route('cart.showAddForm', $ticket->id) }}" class="btn btn-success flex-grow-1"><i class="bi bi-cart-plus me-1"></i> Add</a>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-outline-secondary px-3" title="Details"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search fs-1 text-muted mb-3"></i>
                        <h4 class="fw-bold text-muted">No tickets found</h4>
                        <p>Try adjusting your filters.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
