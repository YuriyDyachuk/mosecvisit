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
            'address'       => $this->adrress,
            'date_event'    => Carbon::parse($this->date_event)->format('Y-m-d') ?? null,
            'time_event'    => Carbon::parse($this->date_event)->format('H:i') ?? null,
            'title'         => $this->title,
            'description'   => $this->description,
            'lat'           => $this->lat,
            'lng'           => $this->lng,
            'author'        => UserResource::make($this->user),
            'created_at'    => $this->created_at,
        ];
    }
}
