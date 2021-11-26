<?php

declare(strict_types=1);

namespace App\Repositories\API;

use App\Models\Verify;
use App\Repositories\BaseRepository;
use App\VO\TwilioVO;
use Illuminate\Database\Eloquent\Collection;

class VerifyRepository extends BaseRepository
{
    public function model(): string
    {
        return Verify::class;
    }

    public function store(TwilioVO $twilioVO): void
    {
        /** @var TYPE_NAME $this */

        $this->query()->create([
            'code'      => $twilioVO->getCode(),
            'user_id'   => $twilioVO->getUserId(),
        ])->refresh();
    }

    public function findById(int $userId): Verify
    {
        /** @var TYPE_NAME $this */

        return $this->query()->where(['user_id' => $userId])->first();
    }



}
