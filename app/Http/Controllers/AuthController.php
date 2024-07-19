<?php

namespace App\Http\Controllers;

use App\Exceptions\ServiceException;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Services\Contracts\AuthServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRegisterRequest $request): JsonResponse{
        try{
            $authRes = $this->authService->register($request);

            return $this->successResponse($authRes, "Successfully register", 201);
        }catch (ServiceException $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function login(AuthLoginRequest $request): JsonResponse{
        try{
            $authRes = $this->authService->login($request);

            return $this->successResponse($authRes, "Successfully login", 200);
        }catch (ServiceException $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}