@extends('layouts.app')

@section('content')
    <h1>{{ $event->name }}</h1>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Date:</strong> {{ $event->date }}</p>
    <p><strong>Venue:</strong> {{ $event->venue->name }}</p>
    <h2>Tickets</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Type</th>
            <th>Price</th>
            <th>Available</th>
        </tr>
        </thead>
        <tbody>
        @foreach($event->tickets as $ticket)
            <tr>
                <td>{{ $ticket->type }}</td>
                <td>{{ $ticket->price }}</td>
                <td>{{ $ticket->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
