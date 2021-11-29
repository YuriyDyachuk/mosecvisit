<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->public_id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'company_name' => $this->company_name,
            'login_methods' => [
                'login' => $this->login,
                'qr'    => 'link to qr code'
            ]
        ];
    }
}
