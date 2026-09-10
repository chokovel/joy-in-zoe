<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Post $post): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->isStaff();
    }
}
