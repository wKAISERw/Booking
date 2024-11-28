@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Чат з {{ $chatUser->name }}</h1>
    <div id="messages" style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
        @foreach($messages as $message)
            <div>
                <strong>{{ $message->sender_id === auth()->id() ? 'Ви' : $chatUser->name }}:</strong>
                {{ $message->message }}
            </div>
        @endforeach
    </div>
    <form id="chat-form">
        <input type="hidden" id="receiver-id" value="{{ $chatUser->id }}">
        <div class="input-group mt-2">
            <input type="text" id="message-input" placeholder="Введіть повідомлення" class="form-control">
            <button type="button" id="send-message" class="btn btn-primary">Надіслати</button>
        </div>
    </form>
</div>

<script>
    window.userId = {{ auth()->id() }};
</script>
@endsection
