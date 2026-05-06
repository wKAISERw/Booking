@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-light me-3 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h2 class="fw-bold mb-0">Edit Ticket Category</h2>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="event_id" class="form-label fw-bold text-muted">Select Event</label>
                            <select class="form-select form-select-lg @error('event_id') is-invalid @enderror" id="event_id" name="event_id" required>
                                <option value="" disabled>-- Choose an event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" data-remaining="{{ $event->remaining_capacity }}" {{ old('event_id', $ticket->event_id) == $event->id ? 'selected' : '' }}>
                                        {{ $event->name }} (Capacity: {{ number_format($event->venue->capacity) }})
                                    </option>
                                @endforeach
                            </select>

                            <div id="capacity-info" class="text-primary small mt-2 fw-bold d-none"></div>

                            @error('event_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="form-label fw-bold text-muted">Category Name (e.g. VIP, Standard)</label>
                            <input type="text" class="form-control form-control-lg @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $ticket->type) }}" placeholder="Enter ticket type" required>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold text-muted">Price ($)</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-currency-dollar text-success"></i></span>
                                    <input type="number" step="0.01" class="form-control border-start-0 @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $ticket->price) }}" placeholder="0.00" required>
                                </div>
                                @error('price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="quantity" class="form-label fw-bold text-muted">Total Available Seats</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-people text-primary"></i></span>
                                    <input type="number" class="form-control border-start-0 @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $ticket->quantity) }}" placeholder="100" required>
                                </div>
                                @error('quantity')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="seat_info" class="form-label fw-bold text-muted">Seat Information (Optional)</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-info-square text-info"></i></span>
                                <input type="text" class="form-control border-start-0 @error('seat_info') is-invalid @enderror" id="seat_info" name="seat_info" value="{{ old('seat_info', $ticket->seat_info) }}" placeholder="e.g. Row 5, Seats 10-20 or 'Free Seating'">
                            </div>
                            @error('seat_info')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="bi bi-save me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventSelect = document.getElementById('event_id');
            const quantityInput = document.getElementById('quantity');
            const capacityInfo = document.getElementById('capacity-info');

            function updateCapacity() {
                const selectedOption = eventSelect.options[eventSelect.selectedIndex];
                if(selectedOption && selectedOption.value !== "") {
                    const remaining = selectedOption.getAttribute('data-remaining');

                    // Показуємо залишок
                    capacityInfo.textContent = `🎟️ Available seats left to add: ${remaining}`;
                    capacityInfo.classList.remove('d-none');

                    // Обмежуємо поле вводу
                    quantityInput.max = remaining;
                    quantityInput.placeholder = `Max: ${remaining}`;
                } else {
                    capacityInfo.classList.add('d-none');
                    quantityInput.removeAttribute('max');
                }
            }

            eventSelect.addEventListener('change', updateCapacity);
            updateCapacity(); // Запускаємо при завантаженні
        });
    </script>
@endsection
