<?php

namespace App\Policies;

use App\Models\Venue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VenuePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Venue $venue)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Venue $venue)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Venue $venue)
    {
        return $user->hasRole('admin');
    }
}
