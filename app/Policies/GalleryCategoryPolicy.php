<?php

namespace App\Policies;

use App\Models\GalleryCategory;
use App\Models\User;

class GalleryCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, GalleryCategory $category): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, GalleryCategory $category): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, GalleryCategory $category): bool
    {
        return $user->isAdmin();
    }
}
