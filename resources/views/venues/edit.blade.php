@extends('layouts.app')

@section('content')
    <h1>Edit Venue</h1>
    <form action="{{ route('venues.update', $venue) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $venue->name }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $venue->address }}" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $venue->capacity }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Venue</button>
    </form>
@endsection
