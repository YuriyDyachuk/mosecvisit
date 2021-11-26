<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\API\Auth\AuthTokenResource;
use App\Services\API\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->userService->exists($request->input('secret_qr_code'));

        return AuthTokenResource::make($user)->response()->setStatusCode(Response::HTTP_OK);
    }
}
