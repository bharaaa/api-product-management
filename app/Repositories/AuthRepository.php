<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function create(User $user): User
    {
        $user->save();
        return $user;
    }

    public function findById(string $id): ?User
    {
        return User::query()->find($id)->first();
    }
}