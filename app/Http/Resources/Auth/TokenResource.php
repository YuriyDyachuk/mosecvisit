<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'token' =>"Bearer {$this->resource->createToken('token-name')->plainTextToken}",
            'message' => 'code was send on phone'
        ];
    }
}
