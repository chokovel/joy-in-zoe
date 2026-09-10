<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view the user management area.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view a given user.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update a given user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can deactivate a given user.
     */
    public function toggle(User $user, User $model): bool
    {
        return $user->isAdmin() && $model->id !== $user->id;
    }

    /**
     * Determine whether the user can delete a given user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $model->id !== $user->id && ! $model->isAdmin();
    }
}
