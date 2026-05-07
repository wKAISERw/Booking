@extends('layouts.app')

@section('content')
    @guest
        <div class="row mb-5">
            <div class="col-12">
                <div class="bg-primary text-white rounded-5 p-5 p-md-5 text-center shadow">
                    <i class="bi bi-ticket-perforated display-1 mb-3 opacity-75"></i>
                    <h1 class="display-4 fw-bold mb-3">Welcome to TicketSys!</h1>
                    <p class="lead mb-4 opacity-75 mx-auto" style="max-width: 600px;">
                        Your ultimate destination for discovering and booking tickets to the best concerts, festivals, and events in the city.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('tickets.index') }}" class="btn btn-light btn-lg text-primary fw-bold px-4 rounded-pill shadow-sm">
                            <i class="bi bi-search me-2"></i> Browse Tickets
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                            Join Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="card border-0 h-100 bg-transparent">
                    <div class="card-body">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 text-primary" style="width: 80px; height: 80px;">
                            <i class="bi bi-calendar2-check display-5"></i>
                        </div>
                        <h4 class="fw-bold">Exclusive Events</h4>
                        <p class="text-muted">Get access to premium venues and unforgettable experiences tailored just for you.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 h-100 bg-transparent">
                    <div class="card-body">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 text-success" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-check display-5"></i>
                        </div>
                        <h4 class="fw-bold">Secure Booking</h4>
                        <p class="text-muted">Your transactions are 100% safe. Instant confirmation and reliable customer support.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 h-100 bg-transparent">
                    <div class="card-body">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 text-warning" style="width: 80px; height: 80px;">
                            <i class="bi bi-lightning-charge display-5"></i>
                        </div>
                        <h4 class="fw-bold">Fast & Easy</h4>
                        <p class="text-muted">Find your event, pick your ticket category, and checkout in just a few clicks.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-light rounded-4 shadow-sm text-center p-5">
                    <h3 class="fw-bold mb-3">Ready to join the fun?</h3>
                    <p class="text-muted mb-4">Don't miss out on upcoming events. Create an account to track your orders and chat with support.</p>
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 me-2">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    @endguest


    @auth
        <div class="mb-5">
            <h1 class="fw-bold">Dashboard</h1>
            <p class="text-muted fs-5">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>!</p>
        </div>

        @if(Auth::user()->hasRole('admin'))
            <h4 class="mb-4 fw-bold text-primary"><i class="bi bi-shield-lock me-2"></i>Admin Controls</h4>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-building fs-2"></i></div>
                            <h5 class="card-title fw-bold">Manage Venues</h5>
                            <a href="{{ route('venues.index') }}" class="btn btn-primary w-100 mt-2">View Venues</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-calendar-event fs-2"></i></div>
                            <h5 class="card-title fw-bold">Manage Events</h5>
                            <a href="{{ route('events.index') }}" class="btn btn-success w-100 mt-2">View Events</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-ticket-perforated fs-2"></i></div>
                            <h5 class="card-title fw-bold">Manage Tickets</h5>
                            <a href="{{ route('tickets.index') }}" class="btn btn-warning text-dark w-100 mt-2">View Tickets</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100 bg-primary text-white">
                        <div class="card-body text-center p-4">
                            <div class="bg-white bg-opacity-25 text-white rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-chat-dots fs-2"></i></div>
                            <h5 class="card-title fw-bold">User Messages</h5>
                            <a href="{{ route('admin.messages') }}" class="btn btn-light text-primary fw-bold w-100 mt-2">View Chats</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-people fs-2"></i>
                            </div>
                            <h5 class="card-title fw-bold">Manage Users</h5>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-dark w-100 mt-2">View Users</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h4 class="mb-4 fw-bold"><i class="bi bi-person-badge me-2"></i>Your Account</h4>
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-info bg-opacity-10 text-info rounded p-3"><i class="bi bi-cart3 fs-3"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Your Cart</h6>
                            <a href="{{ route('cart.index') }}" class="text-decoration-none small">Go to checkout &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-secondary bg-opacity-10 text-secondary rounded p-3"><i class="bi bi-clock-history fs-3"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Order History</h6>
                            <a href="{{ route('orders.history') }}" class="text-decoration-none small">View past orders &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-dark bg-opacity-10 text-dark rounded p-3"><i class="bi bi-person-gear fs-3"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Profile Settings</h6>
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none small">Edit profile &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!Auth::user()->hasRole('admin'))
            <h4 class="mb-4 fw-bold"><i class="bi bi-compass me-2"></i>Explore & Support</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4 text-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-calendar-star fs-2"></i></div>
                            <h5 class="card-title fw-bold">Available Events</h5>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-primary w-100 mt-2">Browse Events</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4 text-center">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-ticket-detailed fs-2"></i></div>
                            <h5 class="card-title fw-bold">Available Tickets</h5>
                            <a href="{{ route('tickets.index') }}" class="btn btn-outline-success w-100 mt-2">Get Tickets</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100 bg-dark text-white">
                        <div class="card-body p-4 text-center">
                            <div class="bg-white bg-opacity-25 text-white rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-headset fs-2"></i></div>
                            <h5 class="card-title fw-bold">Need Help?</h5>
                            <a href="{{ route('user.messages') }}" class="btn btn-light text-dark fw-bold w-100 mt-2">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
