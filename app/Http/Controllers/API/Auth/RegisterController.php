<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\API\SuccessResource;
use App\Services\API\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userService->store($request->only('role', 'name', 'email', 'phone', 'company'));

        return (new SuccessResource($request))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }
}
