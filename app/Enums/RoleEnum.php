<?php

namespace App\Enums;

class RoleEnum extends Enum
{
    const CONTRACTOR_ROLE = 1;
    const VISITOR_ROLE = 2;

    public static function getRoles(): string
    {
        return implode(',',[self::CONTRACTOR_ROLE, self::VISITOR_ROLE]);
    }
}

