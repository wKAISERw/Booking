@extends('layouts.app')

@section('content')
    <h1>Events</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create New Event</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->venue->name }}</td>
                <td>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $events->links() }}
@endsection
