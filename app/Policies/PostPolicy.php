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
        //
    }

    public function update(User $user, Post $post): Response{
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You are not authorised to edit this post.');
    }
}
