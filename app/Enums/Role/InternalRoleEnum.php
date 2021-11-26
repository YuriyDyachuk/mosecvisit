<?php

declare(strict_types=1);

namespace App\Enums\Role;

use App\Enums\Enum;

class InternalRoleEnum extends Enum
{
    const INTERNAL_TYPE_ROLE    = 1;
    const CLIENT_TYPE_ROLE      = 2;
    const EMPLOYEE_TYPE_ROLE    = 3;

    public static function getData(): array
    {
        return [
            self::INTERNAL_TYPE_ROLE    => 'internal',
            self::CLIENT_TYPE_ROLE      => 'client',
            self::EMPLOYEE_TYPE_ROLE    => 'employee',
        ];
    }

    public static function nameByKey($key): string
    {
        return self::getData()[$key] ?? $key;
    }

    public static function implodeData(): string
    {
        return implode(',', array_keys(self::getData()));
    }
}
