<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class VerifyDTO extends DataTransferObject
{
    public int $code;

    public int $userId;
}
