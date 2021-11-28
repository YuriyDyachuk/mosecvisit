<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Users;

use App\Enums\Role\RoleEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->public_id,
            'role'              => !is_null($this->role) ? RoleEnum::nameByKey($this->role) : null,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'name_company'      => $this->name_company,
            'secret_qr_code'    => $this->login,
            'verification'      => $this->verification,
            'qr_code'           => UserQrCodeResource::make($this->qrCode)
        ];
    }
}
