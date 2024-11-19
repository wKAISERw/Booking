@extends('layouts.app')

@section('content')
    <h1>Events</h1>

    <!-- Кнопка для створення нового запису (тільки для адмінів) -->
    @can('create', App\Models\Event::class)
        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create New Event</a>
    @endcan

    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p>{{ Str::limit($event->description, 100) }}</p>
                        <p><strong>Date:</strong> {{ $event->date }}</p>
                        <p><strong>Venue:</strong> {{ $event->venue->name }}</p>
                        
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary">View Details</a>

                        <!-- Дії доступні лише для адмінів -->
                        @can('update', $event)
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Edit</a>
                        @endcan

                        @can('delete', $event)
                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
@endsection
