<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id
                    ? Response::allow()
                    : Response::denyAsNotFound();
    }

    public function delete(User $user, Post $post)
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('Only admins can delete posts.');
    }

}
