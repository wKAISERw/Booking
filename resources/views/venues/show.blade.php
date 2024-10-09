@extends('layouts.app')

@section('content')
    <h1>{{ $venue->name }}</h1>
    <p><strong>Address:</strong> {{ $venue->address }}</p>
    <p><strong>Capacity:</strong> {{ $venue->capacity }}</p>
    <a href="{{ route('venues.edit', $venue) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('venues.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
