<?php

namespace App\Policies;

use App\Models\Subscriber;
use App\Models\User;

class SubscriberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Subscriber $subscriber): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, Subscriber $subscriber): bool
    {
        return $user->isStaff();
    }
}
