@extends('layouts.app')

@section('content')
    <h1>Bookings</h1>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Create New Booking</a>
    <table class="table">
        <thead>
        <tr>
            <th>Customer</th>
            <th>Event</th>
            <th>Ticket Type</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->ticket->event->name }}</td>
                <td>{{ $booking->ticket->type }}</td>
                <td>{{ $booking->quantity }}</td>
                <td>
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
@endsection
