<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user){
        return $user->role == 'admin'
                    ? Response::allow()
                    : Response::deny('Unauthorized to delete this user.');
    }

    public function update(User $user, User $otherUser){
        return $user->id === $otherUser->id
                    ? Response::allow()
                    : Response::deny('Unauthorized to update this user.');
    }
}
