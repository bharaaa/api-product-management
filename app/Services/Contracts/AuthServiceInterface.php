<?php

namespace App\Services\Contracts;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function register(AuthRegisterRequest $request): AuthResource;
    public function login(AuthLoginRequest $request): array;
}