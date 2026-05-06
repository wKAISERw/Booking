@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"><i class="bi bi-tags me-2"></i>Manage Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add New Ticket
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Event</th>
                        <th>Ticket Type</th>
                        <th>Price</th>
                        <th>Total Qty</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $ticket->id }}</td>
                            <td class="fw-bold">{{ $ticket->event->name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $ticket->type }}</span></td>
                            <td class="text-success fw-bold">${{ number_format($ticket->price, 2) }}</td>
                            <td>
                                @if($ticket->quantity > 0)
                                    <span class="badge bg-success rounded-pill">{{ $ticket->quantity }} available</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">Sold Out</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this ticket?')" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No tickets created yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($tickets->hasPages())
            <div class="card-footer bg-white border-top-0 pt-3">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
@endsection
