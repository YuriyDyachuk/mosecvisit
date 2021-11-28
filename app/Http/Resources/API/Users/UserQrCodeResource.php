<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserQrCodeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->public_id,
            'link'  => $this->link
        ];
    }
}
