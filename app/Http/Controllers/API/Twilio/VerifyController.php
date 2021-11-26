<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Twilio;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\PhoneTwilioRequest;
use App\Http\Resources\API\Auth\VerifyCodeResource;
use App\Services\API\UserService;
use App\Services\API\VerifyPhoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VerifyController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @var VerifyPhoneService
     */
    protected VerifyPhoneService $verifyPhoneService;

    public function __construct(
        UserService $userService,
        VerifyPhoneService $verifyPhoneService
    ){
        $this->userService = $userService;
        $this->verifyPhoneService = $verifyPhoneService;
    }

    /**
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function store(PhoneTwilioRequest $request): JsonResponse
    {
        $user = $this->userService->find($request->input('public_id'));
        $this->verifyPhoneService->store($user);

        return (new VerifyCodeResource($this->verifyPhoneService->find($user->id)))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }
}
