@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-lg border-0">
                    @if ($ticket->event->image)
                        <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top img-fluid rounded-top" alt="{{ $ticket->event->name }}" style="height: 400px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img-top img-fluid rounded-top" alt="No Image" style="height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title text-center">{{ $ticket->type }}</h1>
                        <p class="text-center text-muted"><strong>Event:</strong> {{ $ticket->event->name }}</p>
                        <p class="text-center text-muted"><strong>Date:</strong> {{ $ticket->event->date }}</p>
                        <p class="text-center text-muted"><strong>Venue:</strong> {{ $ticket->event->venue->name }}</p>
                        <div class="text-center mb-4">
                            <a href="{{ route('events.show', $ticket->event) }}" class="btn btn-outline-primary btn-sm">View Event Info</a>
                            <a href="{{ route('venues.show', $ticket->event->venue) }}" class="btn btn-outline-secondary btn-sm">View Venue Info</a>
                        </div>
                        <hr>
                        <p class="text-muted"><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                        <p class="text-muted"><strong>Available Quantity:</strong> {{ $ticket->quantity }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-white">
                        <a href="{{ route('cart.showAddForm', $ticket->id) }}" class="btn btn-success btn-lg">Add to Cart</a>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-lg">Back to Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
