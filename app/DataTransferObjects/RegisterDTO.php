<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterDTO extends DataTransferObject
{
    public string $fullName;

    public string $email;

    public string $phone;

    public int $roleId;

    public string $companyName;
}
