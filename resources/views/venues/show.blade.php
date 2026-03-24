@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('venues.index') }}" class="text-decoration-none">Venues</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $venue->name }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm overflow-hidden">
                @if ($venue->image)
                    <img src="{{ asset('storage/' . $venue->image) }}" class="card-img-top object-fit-cover" alt="{{ $venue->name }}" style="height: 400px;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="bi bi-building display-1 opacity-50"></i>
                    </div>
                @endif

                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Venue Details</span>
                        <h1 class="card-title fw-bold mb-0">{{ $venue->name }}</h1>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <div class="col-md-5">
                            <div class="card border border-light bg-light h-100">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-geo-alt-fill text-danger fs-1 mb-3"></i>
                                    <h6 class="fw-bold text-uppercase text-muted mb-2">Address</h6>
                                    <p class="mb-0 fw-semibold">{{ $venue->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card border border-light bg-light h-100">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-people-fill text-primary fs-1 mb-3"></i>
                                    <h6 class="fw-bold text-uppercase text-muted mb-2">Capacity</h6>
                                    <p class="mb-0 fw-semibold fs-5">{{ number_format($venue->capacity) }} <span class="text-muted fs-6">people</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 border-top-0 d-flex justify-content-between align-items-center">
                    <a href="{{ route('venues.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Back to Venues</a>

                    <div class="d-flex gap-2">
                        @can('update', $venue)
                            <a href="{{ route('venues.edit', $venue) }}" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                        @endcan
                        @can('delete', $venue)
                            <form action="{{ route('venues.destroy', $venue) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash me-1"></i>Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
