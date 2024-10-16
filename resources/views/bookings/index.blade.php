@extends('layouts.app')

@section('content')
    <h1>My Bookings</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Order #</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Event</th>
            <th>Ticket Type</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ Auth::user()->email }}</td>
                <td>
                    @foreach($order->items as $item)
                        {{ $item->ticket->event->name }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($order->items as $item)
                        {{ $item->ticket->type }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($order->items as $item)
                        {{ $item->quantity }}<br>
                    @endforeach
                </td>
                <td>
                    @if($order->status === 'pending' || $order->status === 'confirmed')
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
