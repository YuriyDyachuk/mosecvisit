<?php

declare(strict_types=1);

namespace App\Repositories\API;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\VO\UserVO;
use Illuminate\Database\Eloquent\Collection;

class UserServiceRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function store(UserVO $userVO): User
    {
        /** @var TYPE_NAME $this */

        return $this->query()->create([
            'pin'           => $userVO->getPin(),
            'role'          => $userVO->getRole(),
            'name'          => $userVO->getName(),
            'email'         => $userVO->getEmail(),
            'login'         => $userVO->getLogin(),
            'phone'         => $userVO->getPhone(),
        ])->refresh();
    }

    public function show(string $secretQR): User
    {
        return $this->query()->where(['login' => $secretQR])->first();
    }

    public function findById(string $publicId): User
    {
        /** @var TYPE_NAME $this */

        return $this->query()->where(['public_id' => $publicId])->first();
    }

    public function exists(string $secretQR): bool
    {
        return $this->query()->where(['login' => $secretQR])->exists();
    }

}
