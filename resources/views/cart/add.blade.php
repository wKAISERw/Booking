@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Add Ticket to Cart</h1>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $ticket->type }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Event:</strong> {{ $ticket->event->name }}</p>
                <p><strong>Date:</strong> {{ $ticket->event->date }}</p>
                <p><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                <p><strong>Available:</strong> {{ $ticket->quantity }}</p>
                <hr>
                <form action="{{ route('cart.add', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                               value="1" min="1" max="{{ $ticket->quantity }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-3">Add to Cart</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to Tickets</a>
            </div>
        </div>
    </div>
@endsection
