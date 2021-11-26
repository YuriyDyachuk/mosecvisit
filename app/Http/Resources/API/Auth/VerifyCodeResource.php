<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class VerifyCodeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'code' => $this->code,
        ];
    }
}
