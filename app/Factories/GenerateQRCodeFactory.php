<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Support\Str;

class GenerateQRCodeFactory
{
    public function shapingQR(string $email): string
    {
        $symbols = ['@','.'];

        return Str::replace($symbols, '_', $email);
    }
}
