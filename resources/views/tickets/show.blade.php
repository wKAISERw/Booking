@extends('layouts.app')

@section('content')
    <h1>{{ $ticket->event->name }} - {{ $ticket->type }}</h1>
    <p><strong>Price:</strong> ${{ $ticket->price }}</p>
    <p><strong>Available Quantity:</strong> {{ $ticket->quantity }}</p>

    <!-- Add to Cart Form -->
    <form action="{{ route('cart.add', $ticket->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $ticket->quantity }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>

    <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Back to Tickets</a>
@endsection
