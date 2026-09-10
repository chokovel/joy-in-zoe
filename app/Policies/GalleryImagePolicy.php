<?php

namespace App\Policies;

use App\Models\GalleryImage;
use App\Models\User;

class GalleryImagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, GalleryImage $image): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, GalleryImage $image): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, GalleryImage $image): bool
    {
        return $user->isStaff();
    }
}
