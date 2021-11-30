<?php

declare(strict_types=1);

namespace App\Services\Event;

use App\Repositories\EventRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->eventRepository->all();
    }
}
