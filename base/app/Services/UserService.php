<?php

namespace App\Services;

use App\Models\User;

class UserService implements UserServiceInterface
{
    public function updateUser(User $user, array $data)
    {
        $user = $user->all();
        $user[0]->update($data);
        return $user->fresh();
    }
}
