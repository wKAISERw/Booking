@extends('layouts.app')

@section('content')
    <h1 class="fw-bold mb-4"><i class="bi bi-clock-history me-2"></i>Order History</h1>

    @if ($orders->isEmpty())
        <div class="card border-0 shadow-sm text-center p-5">
            <i class="bi bi-receipt display-1 text-muted mb-3 opacity-50"></i>
            <h3 class="fw-bold text-muted">No orders yet</h3>
            <p class="text-muted mb-4">When you purchase tickets, they will appear here.</p>
            <div>
                <a href="{{ route('tickets.index') }}" class="btn btn-primary px-4">Browse Tickets</a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach ($orders as $order)
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div>
                                <h5 class="mb-1 fw-bold">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i> Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</small>
                            </div>
                            <div>
                                @if($order->status === 'successful')
                                    <span class="badge bg-success fs-6 px-3 py-2 rounded-pill"><i class="bi bi-check-circle me-1"></i> Successful</span>
                                @else
                                    <span class="badge bg-secondary fs-6 px-3 py-2 rounded-pill">{{ ucfirst($order->status) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 border-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 border-0">Event</th>
                                        <th class="border-0">Type</th>
                                        <th class="border-0">Price</th>
                                        <th class="border-0">Qty</th>
                                        <th class="pe-4 text-end border-0">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($order->tickets as $ticket)
                                        @php
                                            $subtotal = $ticket->price * $ticket->pivot->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="fw-semibold">{{ $ticket->event->name }}</div>
                                                <div class="small text-muted mb-1">{{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }}</div>
                                                @if($ticket->seat_info)
                                                    <div class="small text-info">
                                                        <i class="bi bi-geo-alt"></i> {{ $ticket->seat_info }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-light text-dark border">{{ $ticket->type }}</span></td>
                                            <td class="text-muted">${{ number_format($ticket->price, 2) }}</td>
                                            <td>{{ $ticket->pivot->quantity }}</td>
                                            <td class="pe-4 text-end fw-bold">${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light p-4 border-top-0 d-flex flex-wrap justify-content-between align-items-center">
                            @if ($order->status === 'successful')
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to request a refund?')">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Request Refund
                                    </button>
                                </form>
                            @else
                                <div></div>
                            @endif
                            <h4 class="mb-0 fw-bold">Total: <span class="text-success">${{ number_format($total, 2) }}</span></h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
