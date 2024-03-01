<?php

namespace App\Policies;

use App\Models\Loaner;
use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === 1;
    }
}
