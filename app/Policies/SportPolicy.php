<?php

namespace App\Policies;

use App\Models\Sport;
use App\Models\User;

class SportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    function update(User $user, Sport $sport) {
        return $user->id === $sport->user_id;
    }

    function delete(User $user, Sport $sport) {
        return $user->id === $sport->user_id;
    }

    function upload(User $user, Sport $sport) {
        return $user->id === $sport->user_id;
    }

    function create(User $user) {
        return true;
    }
}
