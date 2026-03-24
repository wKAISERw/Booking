@extends('layouts.app')

@section('content')
    <div class="mb-5">
        <h1 class="fw-bold">Dashboard</h1>
        @auth
            <p class="text-muted fs-5">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>!</p>
        @endauth
    </div>

    @auth
        @if(Auth::user()->hasRole('admin'))
            <!-- БЛОК 1: Керування (Тільки для адміна) -->
            <h4 class="mb-4 fw-bold text-primary"><i class="bi bi-shield-lock me-2"></i>Admin Controls</h4>
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-building fs-2"></i>
                            </div>
                            <h5 class="card-title fw-bold">Manage Venues</h5>
                            <p class="text-muted small">Add, edit or remove event locations.</p>
                            <a href="{{ route('venues.index') }}" class="btn btn-primary w-100 mt-2">View Venues</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-calendar-event fs-2"></i>
                            </div>
                            <h5 class="card-title fw-bold">Manage Events</h5>
                            <p class="text-muted small">Schedule and organize new events.</p>
                            <a href="{{ route('events.index') }}" class="btn btn-success w-100 mt-2">View Events</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-ticket-perforated fs-2"></i>
                            </div>
                            <h5 class="card-title fw-bold">Manage Tickets</h5>
                            <p class="text-muted small">Control ticket types, pricing and stock.</p>
                            <a href="{{ route('tickets.index') }}" class="btn btn-warning text-dark w-100 mt-2">View Tickets</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- БЛОК 2: Особистий кабінет (Щоб адмін міг купувати квитки) -->
            <h4 class="mb-4 fw-bold"><i class="bi bi-person-badge me-2"></i>Your Account & Shopping</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 text-info rounded p-3">
                                <i class="bi bi-cart3 fs-3"></i>
                            </div>
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
                            <div class="bg-secondary bg-opacity-10 text-secondary rounded p-3">
                                <i class="bi bi-clock-history fs-3"></i>
                            </div>
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
                            <div class="bg-dark bg-opacity-10 text-dark rounded p-3">
                                <i class="bi bi-person-gear fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Profile Settings</h6>
                                <a href="{{ route('profile.edit') }}" class="text-decoration-none small">Edit profile &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- Звичайний користувач -->
            <h4 class="mb-4 fw-bold"><i class="bi bi-compass me-2"></i>Explore</h4>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-4">
                                <i class="bi bi-calendar-star fs-1"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold">Available Events</h5>
                                <p class="text-muted mb-3">Discover what's happening around you.</p>
                                <a href="{{ route('events.index') }}" class="btn btn-outline-primary">Browse Events</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4 d-flex align-items-center gap-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle p-4">
                                <i class="bi bi-ticket-detailed fs-1"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold">Available Tickets</h5>
                                <p class="text-muted mb-3">Secure your spot for upcoming shows.</p>
                                <a href="{{ route('tickets.index') }}" class="btn btn-outline-success">Get Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
