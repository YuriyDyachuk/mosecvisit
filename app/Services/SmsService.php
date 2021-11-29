<?php

declare(strict_types=1);

namespace App\Services;

class SmsService
{
    public function send(int $code, string $phone): void
    {
        //тут создать инстанс твилио и отпрвить код
    }
}
