<?php

declare(strict_types=1);

namespace App\Repositories\API\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\VO\UserVO;

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
            'role'          => $userVO->getRole(),
            'name'          => $userVO->getName(),
            'email'         => $userVO->getEmail(),
            'login'         => $userVO->getLogin(),
            'phone'         => $userVO->getPhone(),
            'name_company'  => $userVO->getNameCompany(),
        ])->refresh();
    }

    public function changeVerify(int $userId): void
    {
        $this->query()->where(['id' => $userId])->update([
            'verification' => true
        ]);
    }

    public function findById($params, string $column): User
    {
        /** @var TYPE_NAME $this */

        return $this->query()->where([$column => $params])->first();
    }

    public function exists($params, string $column): bool
    {
        return $this->query()->where([$column => $params])->exists();
    }

}
