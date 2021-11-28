<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Factories\TwilioFactory;
use App\Models\Profile\Verify;
use App\Models\User;
use App\Repositories\API\User\VerifyRepository;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyPhoneService
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @var TwilioService
     */
    protected TwilioService $twilioService;

    /**
     * @var VerifyRepository
     */
    protected VerifyRepository $verifyRepository;

    /**
     * @var TwilioFactory
     */
    protected TwilioFactory $twilioFactory;

    public function __construct(
        TwilioFactory $twilioFactory,
        UserService $userService,
        TwilioService $twilioService,
        VerifyRepository $verifyRepository
    ){
        $this->twilioService = $twilioService;
        $this->twilioFactory = $twilioFactory;
        $this->userService = $userService;
        $this->verifyRepository = $verifyRepository;
    }

    /**
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function send(string $phone): Verify
    {
        $user = $this->userService->find($phone, 'phone');
        $twilioVO = $this->twilioFactory->create($user->id);
        /* Comment Twilio SMS code */
        // $this->twilioService->messageTo($twilioVO->getCode(), $user);

        return $this->verifyRepository->store($twilioVO);
    }

    public function find(int $code): User
    {
        $userId = $this->verifyRepository->findByUserId($code);
        return $this->userService->updateVerify($userId);
    }
}
