<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\FormatResponse\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\Services\InstitutionService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
        protected InstitutionService $institutionService
    )
    {}

    public function register (RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());
        return ApiResponse::success(
            "Usuario criado com sucesso!",
            201,
            $result
        );
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());
        return ApiResponse::success(
            "Login com sucesso!",
            200,
            $result
        );
    }
}
