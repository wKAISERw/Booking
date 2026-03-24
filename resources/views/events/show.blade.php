@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-decoration-none">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $event->name }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm overflow-hidden">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top object-fit-cover" alt="{{ $event->name }}" style="height: 400px;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="bi bi-calendar-event display-1 opacity-50"></i>
                    </div>
                @endif

                <div class="card-body p-5">
                    <div class="mb-4">
                        <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Event Details</span>
                        <h1 class="card-title fw-bold mb-0">{{ $event->name }}</h1>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-3 me-3 text-primary"><i class="bi bi-calendar3 fs-4"></i></div>
                                <div>
                                    <p class="text-muted small mb-0">Date & Time</p>
                                    <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</div>
                                    <div class="small text-muted">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-3 me-3 text-danger"><i class="bi bi-geo-alt fs-4"></i></div>
                                <div>
                                    <p class="text-muted small mb-0">Venue</p>
                                    <a href="{{ route('venues.show', $event->venue) }}" class="fw-bold text-decoration-none text-dark text-hover-primary">{{ $event->venue->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">

                    <h5 class="fw-bold mb-3">About this event</h5>
                    <p class="text-muted" style="white-space: pre-line;">{{ $event->description }}</p>
                </div>

                <div class="card-footer bg-light p-4 border-top-0 d-flex justify-content-between align-items-center">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Back to Events</a>
                    <a href="{{ route('tickets.index', ['event_id' => [$event->id]]) }}" class="btn btn-success btn-lg px-4 shadow-sm"><i class="bi bi-ticket-perforated me-2"></i>Find Tickets</a>
                </div>
            </div>
        </div>
    </div>
@endsection
