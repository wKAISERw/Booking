@extends('layouts.app')

@section('content')
    <h1>Venues</h1>
    <a href="{{ route('venues.create') }}" class="btn btn-primary">Create New Venue</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($venues as $venue)
            <tr>
                <td>{{ $venue->name }}</td>
                <td>{{ $venue->address }}</td>
                <td>{{ $venue->capacity }}</td>
                <td>
                    <a href="{{ route('venues.show', $venue) }}" class="btn btn-info">View</a>
                    <a href="{{ route('venues.edit', $venue) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('venues.destroy', $venue) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
