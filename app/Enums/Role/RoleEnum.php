<?php

declare(strict_types=1);

namespace App\Enums\Role;

use App\Enums\Enum;

class RoleEnum extends Enum
{
    const CONTRACTOR_TYPE_ROLE  = 1;
    const VISITOR_TYPE_ROLE     = 2;

    public static function getData(): array
    {
        return [
            self::CONTRACTOR_TYPE_ROLE  => 'contractor',
            self::VISITOR_TYPE_ROLE     => 'visitor',
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
