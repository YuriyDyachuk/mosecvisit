<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SuccessResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'status'    => Response::HTTP_OK,
            'message'   => 'Successful action',
            'data'      => []
        ];
    }
}
