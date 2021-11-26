<?php

declare(strict_types=1);

namespace App\Traits\Twilio;

trait TwilioGenerateCode
{
    public function generateSMSCode(): int
    {
        return rand(10**6, 10**6);
    }
}
