@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>
    <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $event->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $event->date) }}" required>
            @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="venue_id">Venue</label>
            <select class="form-control @error('venue_id') is-invalid @enderror" id="venue_id" name="venue_id" required>
                @foreach($venues as $venue)
                    <option value="{{ $venue->id }}" {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>{{ $venue->name }}</option>
                @endforeach
            </select>
            @error('venue_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
@endsection
