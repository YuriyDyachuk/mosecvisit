<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Twilio;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\CodeRequest;
use App\Http\Requests\API\Auth\PhoneTwilioRequest;
use App\Http\Resources\API\Auth\AuthTokenResource;
use App\Http\Resources\API\Auth\VerifyCodeResource;
use App\Services\API\VerifyPhoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SendCodeController extends Controller
{
    /**
     * @var VerifyPhoneService
     */
    protected VerifyPhoneService $verifyPhoneService;

    public function __construct(VerifyPhoneService $verifyPhoneService)
    {
        $this->verifyPhoneService = $verifyPhoneService;
    }

    /**
     * @throws \Twilio\Exceptions\TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function store(PhoneTwilioRequest $request): JsonResponse
    {
        $code = $this->verifyPhoneService->send($request->input('phone'));

        return (new VerifyCodeResource($code))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(CodeRequest $request): JsonResponse
    {
        $user = $this->verifyPhoneService->find((int) $request->input('code'));

        return AuthTokenResource::make($user)->response()->setStatusCode(Response::HTTP_OK);
    }
}
