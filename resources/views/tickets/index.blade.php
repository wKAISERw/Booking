@extends('layouts.app')

@section('content')
    <h1>Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create New Ticket</a>
    <table class="table">
        <thead>
        <tr>
            <th>Event</th>
            <th>Type</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->event->name }}</td>
                <td>{{ $ticket->type }}</td>
                <td>{{ $ticket->price }}</td>
                <td>{{ $ticket->quantity }}</td>
                <td>
                    <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tickets->links() }}
@endsection
