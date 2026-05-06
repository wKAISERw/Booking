@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-headset fs-2 text-success me-3"></i>
                <div>
                    <h1 class="fw-bold mb-0">Contact Support</h1>
                    <p class="text-muted mb-0">Select an administrator to start a chat.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                @if($admins->isEmpty())
                    <div class="card-body text-center p-5">
                        <i class="bi bi-person-x display-1 text-muted opacity-50 mb-3"></i>
                        <h4 class="text-muted fw-bold">No admins available</h4>
                        <p class="text-muted">There are currently no administrators to contact.</p>
                    </div>
                @else
                    <div class="list-group list-group-flush rounded-4">
                        @foreach($admins as $admin)
                            <a href="{{ route('chat', $admin->id) }}" class="list-group-item list-group-item-action p-4 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 45px; height: 45px; font-size: 1.2rem;">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $admin->name }}</h5>
                                        <span class="badge bg-light text-success border border-success mt-1">Support Team</span>
                                    </div>
                                </div>
                                <i class="bi bi-chat-dots fs-4 text-success"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
