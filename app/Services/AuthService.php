<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\RegisterDTO;
use App\DataTransferObjects\VerifyDTO;
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


    public function registerVerify(VerifyDTO $verifyDTO): User
    {
        DB::beginTransaction();

        try {
            $this->userRepository->verifyById($verifyDTO->userId);
            $this->verifyService->deleteByCodeAndUserId($verifyDTO->userId, $verifyDTO->code);
            $this->userRepository->saveLogin($verifyDTO->userId, $this->userService->createLogin());
            $this->userService->createQrCode($this->userRepository->findById($verifyDTO->userId));

            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
        }

        return $this->userRepository->findById($verifyDTO->userId);
    }

    public function loginVerify(VerifyDTO $verifyDTO): ?User
    {
        DB::beginTransaction();

        try {
            $this->userRepository->verifyById($verifyDTO->userId);
            $this->verifyService->deleteByCodeAndUserId($verifyDTO->userId, $verifyDTO->code);
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
        }

        return $this->userRepository->findById($verifyDTO->userId);
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

    public function resetVerify(int $userId): void
    {
        $this->userRepository->resetVerify($userId);
    }

    public function saveLinkQrCode(int $userId, string $link)
    {
        $this->userRepository->saveQrCode($userId, $link);
    }
}
