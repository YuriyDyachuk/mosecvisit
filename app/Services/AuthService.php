<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\RegisterDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class AuthService
{
    private UserRepository $userRepository;

    private VerifyService $verifyService;

    private UserService $userService;

    public function __construct(
        UserRepository $userRepository,
        VerifyService $verifyService,
        UserService $userService
    ) {
        $this->userRepository = $userRepository;
        $this->verifyService = $verifyService;
        $this->userService = $userService;
    }

    public function register(RegisterDTO $registerDTO): User
    {
        $user = $this->userRepository->create($registerDTO);
        $this->userService->sendCode($user);

        return $user ;

    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }


    public function registerVerify(int $code, int $userId): User
    {
        DB::beginTransaction();

        try {
            $this->userRepository->verifyById($userId);
            $this->verifyService->deleteByCodeAndUserId($userId, $code);
            $this->userRepository->saveLogin($userId,$this->userService->createLogin());

            DB::commit();
            return $this->userRepository->findById($userId);
        }catch (\Throwable $exception){
            DB::rollBack();
        }
    }

    public function loginVerify(int $code, int $userId): ?User
    {
        $this->verifyService->deleteByCodeAndUserId($userId, $code);

        return $this->userRepository->findById($userId);
    }

    public function login(string $login): ?User
    {
        $user =  $this->userRepository->findByLogin($login);
        $this->userService->sendCode($user);

        return $user;
    }

    public function existsByLogin(string $login): bool
    {
        return $this->userRepository->existsByLogin($login);
    }
}
