@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Your Cart</h1>
        @if ($cart->tickets->isEmpty())
            <div class="alert alert-info text-center">
                Your cart is empty. <a href="{{ route('tickets.index') }}" class="alert-link">Browse tickets</a>.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Image</th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalPrice = 0; @endphp
                        @foreach ($cart->tickets as $ticket)
                            @php
                                $subtotal = $ticket->price * $ticket->pivot->quantity;
                                $totalPrice += $subtotal;
                            @endphp
                            <tr>
                                <td class="text-center">
                                    @if ($ticket->event->image)
                                        <img src="{{ asset('storage/' . $ticket->event->image) }}" alt="{{ $ticket->event->name }}" class="img-fluid" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/80" alt="No Image" class="img-fluid">
                                    @endif
                                </td>
                                <td class="text-center">
                                    <strong>{{ $ticket->event->name }}</strong><br>
                                    <small>{{ $ticket->event->date }}</small>
                                </td>
                                <td class="text-center">{{ $ticket->type }}</td>
                                <td class="text-center">${{ number_format($ticket->price, 2) }}</td>
                                <td class="text-center">{{ $ticket->pivot->quantity }}</td>
                                <td class="text-center">${{ number_format($subtotal, 2) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $ticket->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this ticket?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-right font-weight-bold">Total:</td>
                            <td class="text-center font-weight-bold">${{ number_format($totalPrice, 2) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('orders.confirm') }}" class="btn btn-primary btn-lg">Proceed to Order</a>
                <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-lg">Continue Shopping</a>
            </div>
        @endif
    </div>
@endsection
