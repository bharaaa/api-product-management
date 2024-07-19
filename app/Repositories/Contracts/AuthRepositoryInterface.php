<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function create(User $user): User;
    public function findById(string $id): ?User;
}