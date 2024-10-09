@extends('layouts.app')

@section('content')
    <h1>Booking Details</h1>
    <p><strong>Customer Name:</strong> {{ $booking->customer_name }}</p>
    <p><strong>Customer Email:</strong> {{ $booking->customer_email }}</p>
    <p><strong>Event:</strong> {{ $booking->ticket->event->name }}</p>
    <p><strong>Ticket Type:</strong> {{ $booking->ticket->type }}</p>
    <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
    <p><strong>Total Price:</strong> ${{ number_format($booking->quantity * $booking->ticket->price, 2) }}</p>
    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
