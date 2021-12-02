<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\RegisterDTO;
use App\Enums\UserStatusEnum;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function create(RegisterDTO $registerDTO): User
    {
        return $this->query()
                ->create([
                    'full_name' => $registerDTO->fullName,
                    'email' => $registerDTO->email,
                    'phone' => $registerDTO->phone,
                    'role_id' => $registerDTO->roleId,
                    'company_name' => $registerDTO->companyName
                ]);
    }

    public function verifyById(int $id): void
    {
         $this->query()
             ->where('id', $id)
             ->update(['verify' => UserStatusEnum::ACTIVE]);
    }

    public function findById(int $id): ?User
    {
       return $this->query()->find($id);
    }

    public function findByLogin(string $login): ?User
    {
        return $this->query()->where('login', $login)->first();
    }

    public function saveLogin(int $userId, string $login): void
    {
        $this->query()
            ->where('id', $userId)
            ->update(['login' => $login]);
    }

    public function existsByLogin(string $login): bool
    {
        return $this->query()
            ->where('login', $login)
            ->exists();
    }

    public function resetVerify(int $id): void
    {
         $this->query()
            ->where('id', $id)
            ->update([
                'verify' => UserStatusEnum::INACTIVE
            ]);
    }

}
