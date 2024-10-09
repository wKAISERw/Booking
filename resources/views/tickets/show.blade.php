@extends('layouts.app')

@section('content')
    <h1>Ticket Details</h1>
    <p><strong>Event:</strong> {{ $ticket->event->name }}</p>
    <p><strong>Type:</strong> {{ $ticket->type }}</p>
    <p><strong>Price:</strong> {{ $ticket->price }}</p>
    <p><strong>Quantity:</strong> {{ $ticket->quantity }}</p>
    <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
