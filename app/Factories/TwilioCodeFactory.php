<?php

declare(strict_types=1);

namespace App\Factories;

class TwilioCodeFactory
{
    public function generateCode(): int
    {
        return rand(100000, 999999);
    }
}
