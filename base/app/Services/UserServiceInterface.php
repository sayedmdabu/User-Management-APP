<?php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function updateUser(User $user, array $data);
}
