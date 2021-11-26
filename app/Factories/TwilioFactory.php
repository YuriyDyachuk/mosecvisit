<?php

declare(strict_types=1);

namespace App\Factories;

use App\Traits\Twilio\TwilioGenerateCode;
use App\VO\TwilioVO;

class TwilioFactory
{
    use TwilioGenerateCode;

    public function create(int $userId): TwilioVO
    {
        return new TwilioVO(
            (int) $userId,
            (int) $this->generateSMSCode(),
        );
    }

}
