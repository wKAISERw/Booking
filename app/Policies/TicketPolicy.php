<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Ticket $ticket)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin');
    }
}
