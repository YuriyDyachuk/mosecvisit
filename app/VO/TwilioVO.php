<?php

declare(strict_types=1);

namespace App\VO;


class TwilioVO
{
    private int $userId;
    private int $code;

    public function __construct(
        $userId,
        $code
    ){
        $this->userId = $userId;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}



