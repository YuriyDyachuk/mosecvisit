<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\API\Auth\AuthTokenResource;
use App\Services\API\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->userService->find($request->input('secret_qrcode'), 'login');

        return AuthTokenResource::make($user)->response()->setStatusCode(Response::HTTP_OK);
    }
}
