<?php

namespace App\Policies;

use App\Models\BlogTag;
use App\Models\User;

class BlogTagPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, BlogTag $tag): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, BlogTag $tag): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, BlogTag $tag): bool
    {
        return $user->isAdmin();
    }
}
