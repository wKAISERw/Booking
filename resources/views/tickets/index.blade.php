@extends('layouts.app')

@section('content')
    <h1>Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create New Ticket</a>

    <div class="container">
        <div class="row">
            @foreach($tickets as $ticket)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($ticket->event->image)
                            <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top img-fluid" alt="{{ $ticket->event->name }}" style="object-fit: cover; height: 200px;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top img-fluid" alt="No Image" style="object-fit: cover; height: 200px;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->type }}</h5>
                            <p><strong>Event:</strong> {{ $ticket->event->name }}</p>
                            <p><strong>Date & Time:</strong> {{ $ticket->event->date }}</p>
                            <p><strong>Price:</strong> ${{ $ticket->price }}</p>
                            <p><strong>Quantity:</strong> {{ $ticket->quantity }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $tickets->links() }}
    </div>
@endsection
