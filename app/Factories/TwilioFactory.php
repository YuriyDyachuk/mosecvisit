<?php

declare(strict_types=1);

namespace App\Factories;

use App\VO\TwilioVO;

class TwilioFactory
{
    /**
     * @var TwilioCodeFactory
     */
    protected TwilioCodeFactory $codeFactory;

    public function __construct(TwilioCodeFactory $codeFactory)
    {
        $this->codeFactory = $codeFactory;
    }


    public function create(int $userId): TwilioVO
    {
        return new TwilioVO(
            (int) $userId,
            (int) $this->codeFactory->generateCode(),
        );
    }

}
