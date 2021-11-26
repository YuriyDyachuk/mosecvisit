<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->public_id,
            'pin'               => $this->pin,
            'role'              => $this->role,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'internal_role'     => $this->internal_role,
            'secret_qr_code'    => $this->login,
        ];
    }
}
