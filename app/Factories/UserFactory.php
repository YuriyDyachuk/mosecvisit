<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\RegisterDTO;
use App\Http\Requests\Auth\RegisterRequest;

class UserFactory
{
    public function create(RegisterRequest $registerRequest): RegisterDTO
    {
        return new RegisterDTO([
            'fullName' => $registerRequest->input('full_name'),
            'email' => $registerRequest->input('email'),
            'phone' => $registerRequest->input('phone'),
            'roleId' => (int) $registerRequest->input('role_id'),
            'companyName' => $registerRequest->input('company_name')
        ]);
    }
}
