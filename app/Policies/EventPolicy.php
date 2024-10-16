<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All authenticated users can view events
    }

    public function view(User $user, Event $event)
    {
        return true; // All authenticated users can view individual events
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Event $event)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Event $event)
    {
        return $user->hasRole('admin');
    }
}
