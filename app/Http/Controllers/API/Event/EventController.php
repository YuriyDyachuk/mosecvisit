<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\EventResourceCollection;
use App\Services\Event\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(): JsonResponse
    {
        return $this->response(new EventResourceCollection($this->eventService->getAll()));
    }
}
