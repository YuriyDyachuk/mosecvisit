<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\RegisterDTO;
use App\DataTransferObjects\VerifyDTO;
use App\Http\Requests\Auth\VerifyRequest;

class UserVerifyFactory
{
    public function create(VerifyRequest $verifyRequest): VerifyDTO
    {
        return new VerifyDTO([
            'code'      => (int) $verifyRequest->input('code'),
            'userId'   => $verifyRequest->user()->id,
        ]);
    }
}
