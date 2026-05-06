<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
Broadcast::channel('chat-room', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
