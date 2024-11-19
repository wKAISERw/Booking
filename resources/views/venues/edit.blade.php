@extends('layouts.app')

@section('content')
    <h1>Edit Venue</h1>
    <form action="{{ route('venues.update', $venue) }}" method="POST" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            @if($venue->image)
                <img src="{{ asset('storage/' . $venue->image) }}" alt="{{ $venue->name }}" class="img-thumbnail mt-2" width="150">
            @endif
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Venue</button>
    </form>
@endsection
