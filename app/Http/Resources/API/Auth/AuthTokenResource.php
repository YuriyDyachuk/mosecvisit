<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Auth;

use App\Http\Resources\API\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'token' => [
                'type'  => 'Bearer',
                'value' => $this->createToken('auth-token')->plainTextToken
            ],
            'profile' => UserResource::make($this)
        ];
    }
}
