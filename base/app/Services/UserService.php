<?php

namespace App\Services;

use App\Models\User;

class UserService implements UserServiceInterface
{
    public function listUsers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function softDeleteUser(User $user)
    {
        $user->delete();
    }

    public function restoreUser(User $user)
    {
        $user->restore();
    }
}
