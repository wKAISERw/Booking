@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4 shadow-sm">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top img-fluid" alt="{{ $event->name }}" style="height: 400px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img-top img-fluid" alt="No Image" style="height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title text-center">{{ $event->name }}</h1>
                        <p class="text-muted text-center"><strong>Date:</strong> {{ $event->date }}</p>
                        <div class="text-center">
                            <p class="text-muted d-inline"><strong>Venue:</strong> {{ $event->venue->name }}</p>
                            <a href="{{ route('venues.show', $event->venue) }}" class="btn btn-outline-primary btn-sm ml-2">View Venue Info</a>
                        </div>
                        <hr>
                        <p class="text-justify">{{ $event->description }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
