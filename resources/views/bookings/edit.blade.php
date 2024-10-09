@extends('layouts.app')

@section('content')
    <h1>Edit Booking</h1>
    <form action="{{ route('bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ticket_id">Event and Ticket</label>
            <select class="form-control @error('ticket_id') is-invalid @enderror" id="ticket_id" name="ticket_id" required>
                @foreach($tickets as $ticket)
                    <option value="{{ $ticket->id }}" {{ old('ticket_id', $booking->ticket_id) == $ticket->id ? 'selected' : '' }}>
                        {{ $ticket->event->name }} - {{ $ticket->type }} (${{ $ticket->price }})
                    </option>
                @endforeach
            </select>
            @error('ticket_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" required>
            @error('customer_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="customer_email">Customer Email</label>
            <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', $booking->customer_email) }}" required>
            @error('customer_email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $booking->quantity) }}" required>
            @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
@endsection
