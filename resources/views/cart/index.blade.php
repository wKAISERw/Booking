@extends('layouts.app')

@section('content')
    <h1 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>Your Cart</h1>

    @if ($cart->tickets->isEmpty())
        <div class="card border-0 shadow-sm text-center p-5">
            <i class="bi bi-cart-x display-1 text-muted mb-3 opacity-50"></i>
            <h3 class="fw-bold text-muted">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any tickets yet.</p>
            <div>
                <a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg px-5 rounded-pill">Browse Tickets</a>
            </div>
        </div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Event</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="pe-4 text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody class="border-top-0">
                            @php $totalPrice = 0; @endphp
                            @foreach ($cart->tickets as $ticket)
                                @php
                                    $subtotal = $ticket->price * $ticket->pivot->quantity;
                                    $totalPrice += $subtotal;
                                @endphp
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($ticket->event->image)
                                                <img src="{{ asset('storage/' . $ticket->event->image) }}" alt="{{ $ticket->event->name }}" class="rounded object-fit-cover shadow-sm" style="width: 60px; height: 60px;">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 60px; height: 60px;">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $ticket->event->name }}</h6>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">{{ $ticket->type }}</span></td>
                                    <td>${{ number_format($ticket->price, 2) }}</td>
                                    <td><span class="fw-bold">{{ $ticket->pivot->quantity }}</span></td>
                                    <td class="fw-bold text-success">${{ number_format($subtotal, 2) }}</td>
                                    <td class="pe-4 text-end">
                                        <form action="{{ route('cart.remove', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm rounded-circle" title="Remove" onclick="return confirm('Remove this ticket from cart?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Tickets ({{ $cart->tickets->sum('pivot.quantity') }})</span>
                            <span>${{ number_format($totalPrice, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Taxes & Fees</span>
                            <span>$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-success">${{ number_format($totalPrice, 2) }}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('orders.confirm') }}" class="btn btn-primary btn-lg shadow-sm">Proceed to Checkout</a>
                            <a href="{{ route('tickets.index') }}" class="btn btn-light text-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
