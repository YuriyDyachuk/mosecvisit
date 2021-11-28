<?php

declare(strict_types=1);

namespace App\Repositories\API\User;

use App\Models\Profile\UserQrCode;
use App\Repositories\BaseRepository;

class UserQrRepository extends BaseRepository
{
    public function model(): string
    {
        return UserQrCode::class;
    }

    public function create(string $link, int $userId): void
    {
        $this->query()->create([
            'link'      => $link,
            'user_id'   => $userId
        ])->refresh();
    }
}
