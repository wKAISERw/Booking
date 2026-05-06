@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Create New Venue</h1>
                <form action="{{ route('venues.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
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
                        <div id="image-preview-wrapper" class="mt-3" style="display: none;">
                            <p class="text-muted mb-1">Preview:</p>
                            <img id="image-preview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 250px; object-fit: cover;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Venue</button>
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
                document.getElementById('image-preview-wrapper').style.display = 'none';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById('image-preview').src = event.target.result;
                document.getElementById('image-preview-wrapper').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
