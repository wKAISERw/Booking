@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>
    @if($cart && $cart->items->isNotEmpty())
        <table>
            <thead>
            <tr>
                <th>Ticket</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->ticket->event->name }} - {{ $item->ticket->type }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>{{ $item->ticket->price * $item->quantity }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <button type="submit">Place Order</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
