<?php

declare(strict_types=1);

namespace App\Repositories\API\User;

use App\Models\Profile\Verify;
use App\Repositories\BaseRepository;
use App\VO\TwilioVO;
use Illuminate\Database\Eloquent\Collection;

class VerifyRepository extends BaseRepository
{
    public function model(): string
    {
        return Verify::class;
    }

    public function store(TwilioVO $twilioVO): Verify
    {
        /** @var TYPE_NAME $this */

        return $this->query()->firstOrCreate(
            ['user_id'   => $twilioVO->getUserId()],
            ['code'      => $twilioVO->getCode()]
        )->refresh();
    }

    public function findByUserId(int $code): int
    {
        /** @var TYPE_NAME $this */

        return $this->query()->where(['code' => $code])->value('user_id');
    }



}
