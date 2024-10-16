@extends('layouts.app')

@section('content')
    <h1>Your Order</h1>
    <p><strong>Order #:</strong> {{ $order->id }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <p><strong>Customer Name:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Customer Email:</strong> {{ Auth::user()->email }}</p>

    <ul>
        @foreach($order->items as $item)
            <li>
                {{ $item->ticket->event->name }} - {{ $item->ticket->type }}
                (Quantity: {{ $item->quantity }}, Price: ${{ $item->price }})
            </li>
        @endforeach
    </ul>

    @if($order->status === 'pending')
        <form action="{{ route('orders.cancel', $order) }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit">Cancel Order</button>
        </form>
    @endif

    @if($order->status === 'pending')
        <form action="{{ route('orders.confirm', $order) }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">Confirm Order</button>
        </form>
    @endif
@endsection
