@extends('layouts.app')

@section('content')
    <h1>Your Orders</h1>
    @if($orders->isNotEmpty())
        @foreach($orders as $order)
            <div>
                <h2>Order #{{ $order->id }}</h2>
                <p>Status: {{ $order->status }}</p>
                <ul>
                    @foreach($order->items as $item)
                        <li>
                            <strong>Event:</strong> {{ $item->ticket->event->name }} <br>
                            <strong>Ticket Type:</strong> {{ $item->ticket->type }} <br>
                            <strong>Quantity:</strong> {{ $item->quantity }} <br>
                            <strong>Price:</strong> ${{ $item->price }} <br>
                        </li>
                    @endforeach
                </ul>

                <!-- Перевірка статусу перед відображенням кнопок -->
                @if($order->status === 'pending')
                    <form action="{{ route('orders.cancel', $order) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit">Cancel Order</button>
                    </form>

                    <form action="{{ route('orders.confirm', $order) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Confirm Order</button>
                    </form>
                @endif
            </div>
        @endforeach
    @else
        <p>You have no orders.</p>
    @endif
@endsection
