@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Confirm Your Order</h1>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Summary</h5>
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
                                @foreach ($cart->tickets as $ticket)
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
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Back to Cart</a>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
