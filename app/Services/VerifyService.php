<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\VerifyRepository;

class VerifyService
{
    private VerifyRepository $verifyRepository;

    public function __construct(VerifyRepository $verifyRepository)
    {
        $this->verifyRepository = $verifyRepository;
    }

    public function existByCodeAndUserId(int $code, int $userId): bool
    {
        return  $this->verifyRepository->existByCodeAndUserId($code, $userId);
    }

    public function deleteByCodeAndUserId(int $userId, int $code): void
    {
        $this->verifyRepository->cleanByCodeAndUserId($code, $userId);
    }

}
