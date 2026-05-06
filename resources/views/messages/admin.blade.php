@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-chat-left-dots fs-2 text-primary me-3"></i>
                <h1 class="fw-bold mb-0">User Messages</h1>
            </div>

            <div class="card border-0 shadow-sm">
                @if($users->isEmpty())
                    <div class="card-body text-center p-5">
                        <i class="bi bi-inbox display-1 text-muted opacity-50 mb-3"></i>
                        <h4 class="text-muted fw-bold">No messages yet</h4>
                        <p class="text-muted">You don't have any active chats with users right now.</p>
                    </div>
                @else
                    <div class="list-group list-group-flush rounded-4">
                        @foreach($users as $user)
                            <a href="{{ route('chat', ['id' => $user->id]) }}" class="list-group-item list-group-item-action p-4 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 45px; height: 45px; font-size: 1.2rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $user->name }}</h5>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
