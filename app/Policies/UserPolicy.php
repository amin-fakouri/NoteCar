<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function managerRole(User $user): bool
    {
        return $user->role_code == '1';
    }

    public function employeeRole(User $user): bool
    {
        return $user->role_code == '2';
    }
}
