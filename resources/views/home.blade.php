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
                <!-- КАРТКА ПОВІДОМЛЕНЬ ДЛЯ АДМІНА -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm card-hover h-100 bg-primary text-white">
                        <div class="card-body text-center p-4">
                            <div class="bg-white bg-opacity-25 text-white rounded-circle d-inline-flex p-3 mb-3"><i class="bi bi-chat-dots fs-2"></i></div>
                            <h5 class="card-title fw-bold">User Messages</h5>
                            <a href="{{ route('admin.messages') }}" class="btn btn-light text-primary fw-bold w-100 mt-2">View Chats</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- БЛОК 2: Особистий кабінет (Для всіх авторизованих) -->
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
            <!-- БЛОК 3: Дослідження та Підтримка (Тільки для звичайного юзера) -->
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
                <!-- КАРТКА ПІДТРИМКИ ДЛЯ ЮЗЕРА -->
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
