<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Models\User;
use App\Factories\UserFactory;
use App\Repositories\API\User\UserServiceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    /**
     * @var UserFactory
     */
    protected UserFactory $userFactory;

    /**
     * @var UserQrCodeService
     */
    protected UserQrCodeService $qrCodeService;

    /**
     * @var VerifyPhoneService
     */
    protected VerifyPhoneService $verifyPhoneService;

    /**
     * @var UserServiceRepository
     */
    protected UserServiceRepository $userRepository;

    public function __construct(
        UserFactory $userFactory,
        UserQrCodeService $qrCodeService,
        UserServiceRepository $userRepository
    ){
        $this->userFactory = $userFactory;
        $this->qrCodeService = $qrCodeService;
        $this->userRepository = $userRepository;
    }

    public function store(array $data): void
    {
        $userVO = $this->userFactory->create($data);
        $user = $this->userRepository->store($userVO);


        if (!is_null($userVO->getLogin())) {
            $this->qrCodeService->generation($userVO->getLogin(), $user->id);
        }
    }

    public function find($params, string $column): User
    {
        if (!$this->userRepository->exists($params, $column)) {
            throw new NotFoundHttpException('User not found.', null,Response::HTTP_NOT_FOUND);
        }

        return $this->userRepository->findById($params, $column);
    }

    public function updateVerify(int $userId): User
    {
        $this->userRepository->changeVerify($userId);

        return $this->userRepository->findById($userId, 'id');
    }
}
