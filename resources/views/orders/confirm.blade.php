@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="fw-bold"><i class="bi bi-check-circle text-success me-2"></i>Confirm Your Order</h1>
                <p class="text-muted">Please review your tickets before placing the final order.</p>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="mb-0 fw-bold">Order Summary</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 border-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4 border-0">Event</th>
                                <th class="border-0">Ticket Type</th>
                                <th class="border-0">Price</th>
                                <th class="border-0">Qty</th>
                                <th class="pe-4 text-end border-0">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total = 0; @endphp
                            @foreach ($cart->tickets as $ticket)
                                @php
                                    $subtotal = $ticket->price * $ticket->pivot->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold">{{ $ticket->event->name }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">{{ $ticket->type }}</span></td>
                                    <td class="text-muted">${{ number_format($ticket->price, 2) }}</td>
                                    <td><span class="fw-semibold">{{ $ticket->pivot->quantity }}</span></td>
                                    <td class="pe-4 text-end fw-bold">${{ number_format($subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light p-4 border-top-0 d-flex justify-content-between align-items-center">
                    <span class="fs-5 text-muted">Total Amount:</span>
                    <span class="fs-3 fw-bold text-success">${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg"><i class="bi bi-arrow-left me-2"></i>Back to Cart</a>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                        Confirm & Place Order <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
