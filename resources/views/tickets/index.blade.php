@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Available Tickets</h1>

        <div class="row">
            <!-- Секція фільтрів -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <strong>Filters</strong>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('tickets.index') }}">
                            <!-- Пошук -->
                            <div class="mb-4">
                                <label for="search" class="form-label">Search by Name</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Type to search..." value="{{ request('search') }}">
                            </div>

                            <!-- Фільтр за ціною -->
                            <div class="mb-4">
                                <label for="price-range" class="form-label">Price</label>
                                <div class="input-group">
                                    <input type="number" name="min_price" class="form-control" placeholder="From" value="{{ request('min_price') }}">
                                    <input type="number" name="max_price" class="form-control" placeholder="To" value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <!-- Фільтр за подією -->
                            <div class="mb-4">
                                <label for="event" class="form-label">Event</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        @foreach($events as $event)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="event_id[]" value="{{ $event->id }}" {{ request('event_id') && in_array($event->id, request('event_id')) ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $event->name }} ({{ $event->tickets_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Сортування -->
                            <div class="mb-4">
                                <label for="sort" class="form-label">Sort by Price</label>
                                <select name="sort" id="sort" class="form-control">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Default</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>

                            <!-- Кнопка застосування фільтрів -->
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Секція результатів -->
            <div class="col-md-9">
                <div class="row">
                    @foreach ($tickets as $ticket)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-lg border-0">
                                @if ($ticket->event->image)
                                    <img src="{{ asset('storage/' . $ticket->event->image) }}" alt="{{ $ticket->event->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="No Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $ticket->type }}</h5>
                                    <p class="mb-1 text-muted"><strong>Event:</strong> {{ $ticket->event->name }}</p>
                                    <p class="mb-1 text-muted"><strong>Date:</strong> {{ $ticket->event->date }}</p>
                                    <p class="mb-1 text-muted"><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                                    <p class="mb-1 text-muted"><strong>Available:</strong> {{ $ticket->quantity }}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center bg-white">
                                    <a href="{{ route('cart.showAddForm', $ticket->id) }}" class="btn btn-sm btn-success">Add to Cart</a>
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
