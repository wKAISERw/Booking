@extends('layouts.app')

@section('content')
    <h1>Create New Venue</h1>
    <form action="{{ route('venues.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Venue</button>
    </form>
@endsection
