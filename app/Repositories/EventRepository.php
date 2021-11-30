<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;

class EventRepository extends BaseRepository
{
    public function model(): string
    {
        return Event::class;
    }

    public function all(): LengthAwarePaginator
    {
        return $this->query()->paginate(10);
    }
}
