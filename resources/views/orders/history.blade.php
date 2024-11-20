@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Order History</h1>
        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                You have no orders yet. <a href="{{ route('tickets.index') }}" class="alert-link">Browse tickets</a>.
            </div>
        @else
            @foreach ($orders as $order)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Order #{{ $order->id }} - {{ ucfirst($order->status) }}</h5>
                        <small>Placed on {{ $order->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
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
                                        <td>{{ $ticket->event->name }}</td>
                                        <td>{{ $ticket->type }}</td>
                                        <td>${{ number_format($ticket->price, 2) }}</td>
                                        <td>{{ $ticket->pivot->quantity }}</td>
                                        <td>${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-active">
                                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if ($order->status === 'successful')
                        <div class="card-footer d-flex justify-content-end">
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Refund Order</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection
