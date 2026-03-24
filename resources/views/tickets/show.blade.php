@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-decoration-none">Tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $ticket->type }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm overflow-hidden">
                @if ($ticket->event->image)
                    <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top object-fit-cover" alt="{{ $ticket->event->name }}" style="height: 350px;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 350px;">
                        <i class="bi bi-image display-1 opacity-50"></i>
                    </div>
                @endif

                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Ticket Details</span>
                            <h1 class="card-title fw-bold mb-0">{{ $ticket->type }}</h1>
                        </div>
                        <h2 class="text-success fw-bold mb-0">${{ number_format($ticket->price, 2) }}</h2>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-3 me-3 text-primary"><i class="bi bi-calendar-event fs-4"></i></div>
                                <div>
                                    <p class="text-muted small mb-0">Event</p>
                                    <a href="{{ route('events.show', $ticket->event) }}" class="fw-bold text-decoration-none text-dark">{{ $ticket->event->name }}</a>
                                    <div class="small text-muted">{{ \Carbon\Carbon::parse($ticket->event->date)->format('F d, Y \a\t H:i') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-3 me-3 text-danger"><i class="bi bi-geo-alt fs-4"></i></div>
                                <div>
                                    <p class="text-muted small mb-0">Venue</p>
                                    <a href="{{ route('venues.show', $ticket->event->venue) }}" class="fw-bold text-decoration-none text-dark">{{ $ticket->event->venue->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info d-flex align-items-center border-0">
                        <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Hurry up!</strong> Only <strong>{{ $ticket->quantity }}</strong> tickets left in stock.
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 border-top-0 d-flex justify-content-between align-items-center">
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Back</a>
                    <a href="{{ route('cart.showAddForm', $ticket->id) }}" class="btn btn-success btn-lg px-5 shadow-sm"><i class="bi bi-cart-plus me-2"></i>Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
@endsection
