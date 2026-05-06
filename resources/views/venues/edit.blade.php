@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Edit Venue</h1>
                <form action="{{ route('venues.update', $venue) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $venue->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $venue->address) }}" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="capacity">Capacity</label>
                        <input type="number" min="1" class="form-control" id="capacity" name="capacity" value="..." required>
                        @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file"
                               class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image"
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Поточне зображення --}}
                        <div id="image-preview-wrapper" class="mt-3">
                            <p class="text-muted mb-1" id="preview-label">
                                @if($venue->image) Current image: @else Preview: @endif
                            </p>
                            <img id="image-preview"
                                 src="{{ $venue->image ? asset('storage/' . $venue->image) : '#' }}"
                                 alt="Preview"
                                 class="img-thumbnail"
                                 style="max-height: 250px; object-fit: cover; {{ $venue->image ? '' : 'display:none;' }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Venue</button>
                    <a href="{{ route('venues.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!allowed.includes(file.type)) {
                alert('Please select a valid image file (JPEG, PNG, GIF, WEBP).');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                const preview = document.getElementById('image-preview');
                const label = document.getElementById('preview-label');
                preview.src = event.target.result;
                preview.style.display = 'block';
                label.textContent = 'New image preview:';
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
