@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4 shadow-sm">
                    @if ($ticket->event->image)
                        <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top img-fluid" alt="{{ $ticket->event->name }}" style="height: 400px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img-top img-fluid" alt="No Image" style="height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title text-center">{{ $ticket->type }}</h1>
                        <p class="text-center"><strong>Event:</strong> {{ $ticket->event->name }}</p>
                        <p class="text-center"><strong>Date & Time:</strong> {{ $ticket->event->date }}</p>
                        <p class="text-center"><strong>Venue:</strong> {{ $ticket->event->venue->name }}</p>
                        <div class="text-center">
                            <a href="{{ route('events.show', $ticket->event) }}" class="btn btn-outline-primary btn-sm">View Event Info</a>
                            <a href="{{ route('venues.show', $ticket->event->venue) }}" class="btn btn-outline-secondary btn-sm">View Venue Info</a>
                        </div>
                        <hr>
                        <p><strong>Price:</strong> ${{ $ticket->price }}</p>
                        <p><strong>Available Quantity:</strong> {{ $ticket->quantity }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('cart.add', $ticket->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $ticket->quantity }}" required class="form-control d-inline w-auto">
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Add to Cart</button>
                        </form>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary mt-3">Back to Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
