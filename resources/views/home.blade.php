@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Welcome to Ticket Booking System</h1>

        @auth
            <p>Hello, {{ Auth::user()->name }}!</p>

            @if(Auth::user()->hasRole('admin'))
                <h2>Admin Dashboard</h2>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Manage Venues</h5>
                                <a href="{{ route('venues.index') }}" class="btn btn-primary">View Venues</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Manage Events</h5>
                                <a href="{{ route('events.index') }}" class="btn btn-primary">View Events</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Manage Tickets</h5>
                                <a href="{{ route('tickets.index') }}" class="btn btn-primary">View Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h2>User Dashboard</h2>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">My Bookings</h5>
                                <a href="{{ route('bookings.index') }}" class="btn btn-primary">View Bookings</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Available Events</h5>
                                <a href="{{ route('events.index') }}" class="btn btn-primary">View Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> to start booking tickets.</p>
        @endauth
    </div>
@endsection
