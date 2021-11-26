<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Factories\TwilioFactory;
use App\Models\User;
use App\Repositories\API\VerifyRepository;
use App\Traits\Twilio\UserCodeTwilioSMSTrait;

class VerifyPhoneService
{
    use UserCodeTwilioSMSTrait;

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
        VerifyRepository $verifyRepository
    ){
        $this->twilioFactory = $twilioFactory;
        $this->verifyRepository = $verifyRepository;
    }

    /**
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function store(User $user): void
    {
        $twilioVO = $this->twilioFactory->create($user->id);
        $this->messageTo($twilioVO->getCode(), $user);

        $this->verifyRepository->store($twilioVO);
    }

    public function find(int $userId): \App\Models\Verify
    {
        return $this->verifyRepository->findById($userId);
    }
}
