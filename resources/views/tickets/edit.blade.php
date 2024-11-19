@extends('layouts.app')

@section('content')
    <h1>Edit Ticket</h1>
    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="event_id">Event</label>
            <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id', $ticket->event_id) == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                @endforeach
            </select>
            @error('event_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div id="event-image" class="mb-3">
            @if ($ticket->event->image)
                <img src="{{ asset('storage/' . $ticket->event->image) }}" class="img-fluid" alt="{{ $ticket->event->name }}" style="object-fit: cover; height: 200px;">
            @endif
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $ticket->type) }}" required>
            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $ticket->price) }}" required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $ticket->quantity) }}" required>
            @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Ticket</button>
    </form>
@endsection
