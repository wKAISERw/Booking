@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Welcome to Ticket Booking System</h1>
        <p>Choose a category from the navigation bar above to get started.</p>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Venues</h5>
                        <p class="card-text">Explore our available venues.</p>
                        <a href="{{ route('venues.index') }}" class="btn btn-primary">View Venues</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text">Check out upcoming events.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">View Events</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tickets</h5>
                        <p class="card-text">Browse available tickets.</p>
                        <a href="{{ route('tickets.index') }}" class="btn btn-primary">View Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings</h5>
                        <p class="card-text">Manage your bookings.</p>
                        <a href="{{ route('bookings.index') }}" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
