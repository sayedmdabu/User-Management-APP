<?php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function listUsers();
    public function createUser(array $data);
    public function updateUser(User $user, array $data);
    public function softDeleteUser(User $user);
    public function restoreUser(User $user);
}
