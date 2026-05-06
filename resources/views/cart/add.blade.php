@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white p-4 border-0">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-cart-plus me-2"></i>Add to Cart</h4>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">{{ $ticket->type }}</h5>
                        <span class="badge bg-success fs-6">${{ number_format($ticket->price, 2) }}</span>
                    </div>

                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2"><i class="bi bi-calendar-event me-2"></i> <strong>Event:</strong> {{ $ticket->event->name }}</li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i> <strong>Date:</strong> {{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y H:i') }}</li>
                        <li><i class="bi bi-ticket me-2"></i> <strong>Available:</strong> {{ $ticket->quantity }}</li>
                    </ul>

                    <hr class="text-muted opacity-25 mb-4">

                    <form action="{{ route('cart.add', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light"><i class="bi bi-123"></i></span>
                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="1" min="1" max="{{ min(4, $ticket->quantity) }}" required>                            </div>
                            @error('quantity')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-check2-circle me-2"></i>Confirm Addition</button>
                            <a href="{{ route('tickets.index') }}" class="btn btn-light text-muted">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
