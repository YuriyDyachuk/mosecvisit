<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Factories\UserFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Services\AuthService;
use App\Services\UserService;
use App\Services\VerifyService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    private AuthService $authService;

    private UserFactory $userFactory;

    private UserService $userService;

    private VerifyService $verifyService;

    public function __construct(
        AuthService $authService,
        UserFactory $userFactory,
        UserService $userService,
        VerifyService $verifyService
    ) {
        $this->authService = $authService;
        $this->userFactory = $userFactory;
        $this->userService = $userService;
        $this->verifyService = $verifyService;
    }

    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        DB::beginTransaction();
        try {
            $userFactory = $this->userFactory->create($registerRequest);
            $registerUser = $this->authService->register($userFactory);
            $this->userService->sendCode($registerUser);

            DB::commit();
            return $this->response( TokenResource::make($registerUser));
        }catch (\Throwable $exception){
            DB::rollBack();

            return $this->response(['message' => $exception->getMessage()]);
        }
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        if (!$this->authService->existsByLogin($loginRequest->input('login'))){
            throw new NotFoundHttpException();
        }

        $user = $this->authService->login($loginRequest->input('login'));

        return $this->response(TokenResource::make($user));
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return $this->response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    public function registerVerify(VerifyRequest $verifyRequest): JsonResponse
    {
        if (!$this->verifyService->existByCodeAndUserId(
            (int) $verifyRequest->input('code'),
            $verifyRequest->user()->id
        )){
            throw new NotFoundHttpException();
        }

        $this->authService->registerVerify(
            (int) $verifyRequest->input('code'),
            $verifyRequest->user()->id
        );

        return $this->response('Success');
    }

    public function loginVerify(VerifyRequest $verifyRequest): JsonResponse
    {
        if (!$this->verifyService->existByCodeAndUserId(
            (int) $verifyRequest->input('code'),
            $verifyRequest->user()->id
        )){
            throw new NotFoundHttpException();
        }

        $this->authService->loginVerify(
            (int) $verifyRequest->input('code'),
            $verifyRequest->user()->id
        );

        return $this->response('Success');
    }
}
