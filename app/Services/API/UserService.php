<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Models\User;
use App\Factories\UserFactory;
use App\Repositories\API\UserServiceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class UserService
{
    /**
     * @var UserFactory
     */
    protected UserFactory $userFactory;

    /**
     * @var UserServiceRepository
     */
    protected UserServiceRepository $userRepository;

    public function __construct(
        UserFactory $userFactory,
        UserServiceRepository $userRepository
    ){
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    public function store(array $data): User
    {
        $userVO = $this->userFactory->create($data);

        return $this->userRepository->store($userVO);
    }

    public function find(string $publicId): User
    {
        return $this->userRepository->findById($publicId);
    }

    /**
     * @throws \Exception
     */
    public function exists(string $secretQR): User
    {
        if (!$this->userRepository->exists($secretQR)) {
            throw new ModelNotFoundException('User not found.', Response::HTTP_UNAUTHORIZED);
        }

        return $this->userRepository->show($secretQR);
    }
}
