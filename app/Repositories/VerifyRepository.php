<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Verify;

class VerifyRepository extends BaseRepository
{
    public function model(): string
    {
        return Verify::class;
    }

    public function existByCodeAndUserId(int $code, int $userId): bool
    {
        return $this->query()
            ->where([
            'user_id' => $userId,
            'code' => $code
        ])->exists();
    }

    public function cleanByCodeAndUserId(int $code, int $userId): void
    {
         $this->query()
            ->where([
                'user_id' => $userId,
                'code' => $code
            ])->delete();
    }


}
