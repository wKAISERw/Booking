@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('events.index') }}" class="btn btn-light me-3 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h2 class="fw-bold mb-0">Create New Event</h2>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-muted">Event Name</label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Rock Concert 2026" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold text-muted">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Tell us about the event..." required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-bold text-muted">Date & Time</label>
                                <input type="datetime-local" class="form-control form-control-lg @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                                @error('date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="venue_id" class="form-label fw-bold text-muted">Venue</label>
                                <select class="form-select form-select-lg @error('venue_id') is-invalid @enderror" id="venue_id" name="venue_id" required>
                                    <option value="" disabled selected>-- Choose Venue --</option>
                                    @foreach($venues as $venue)
                                        <option value="{{ $venue->id }}" {{ old('venue_id') == $venue->id ? 'selected' : '' }}>
                                            {{ $venue->name }} (Capacity: {{ number_format($venue->capacity) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('venue_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold text-muted">Event Banner (Optional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div id="image-preview-wrapper" class="mt-3">
                                <p class="text-muted small mb-1" id="preview-label" style="display:none;">Image Preview:</p>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center overflow-hidden border" style="height: 300px; width: 100%;">
                                    <img id="image-preview" src="#" alt="Preview"
                                         style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;">
                                    <i id="preview-placeholder" class="bi bi-image text-muted opacity-25" style="font-size: 5rem;"></i>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="bi bi-calendar-plus me-2"></i> Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const label = document.getElementById('preview-label');
            const placeholder = document.getElementById('preview-placeholder');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                    label.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                label.style.display = 'none';
                placeholder.style.display = 'block';
            }
        });
    </script>
@endsection
