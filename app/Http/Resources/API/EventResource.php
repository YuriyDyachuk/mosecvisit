<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->public_id,
            'address'       => $this->address,
            'date_event'    => $this->start_event_date,
            'title'         => $this->title,
            'description'   => $this->description,
            'lat'           => $this->lat,
            'lng'           => $this->lng,
            'created_at'    => $this->created_at,
        ];
    }
}
