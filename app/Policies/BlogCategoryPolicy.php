<?php

namespace App\Policies;

use App\Models\BlogCategory;
use App\Models\User;

class BlogCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, BlogCategory $category): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, BlogCategory $category): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, BlogCategory $category): bool
    {
        return $user->isAdmin();
    }
}
