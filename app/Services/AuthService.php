<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService implements AuthServiceInterface
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(AuthRegisterRequest $request): AuthResource
    {
        $data = $request->validated();

        try {
            $data['password'] = Hash::make($data['password']);
            $data['username'] = explode('@', $data['email'])[0];

            $user = new User($data);
            $user = $this->authRepository->create($user);

            return new AuthResource($user);
        } catch (\Exception $e) {
            throw new ServiceException("Can't register", 500);
        }
    }

    public function login(AuthLoginRequest $request): array
    {
        $data = $request->validated();

        if (!$token = JWTAuth::attempt($data)) {
            throw new ServiceException("Invalid credentials", 401);
        }

        $user = Auth::user();
        return [
            "email" => $user->email,
            "token" => $token
        ];
    }

    public function logout(Request $request): void
    {
        try {
            Auth::logout();
            JWTAuth::invalidate($request->bearerToken());
        } catch (\Exception $e) {
            throw new ServiceException("Internal server error", 500);
        }
    }
}
