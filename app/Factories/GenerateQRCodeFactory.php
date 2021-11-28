<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Support\Str;

class GenerateQRCodeFactory
{
    public function shapingQR(): string
    {
        return Str::random(15);
    }
}
