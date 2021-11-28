<?php

declare(strict_types=1);

namespace App\Factories;

use App\VO\UserVO;
use App\Factories\GenerateQRCodeFactory;

class UserFactory
{
    /**
     * @var GenerateQRCodeFactory
     */
    protected GenerateQRCodeFactory $generateQRCodeFactory;

    public function __construct(GenerateQRCodeFactory $generateQRCodeFactory)
    {
        $this->generateQRCodeFactory = $generateQRCodeFactory;
    }

    public function create(array $data): UserVO
    {
        return new UserVO(
            isset($data['role']) ? (int) $data['role'] : null,
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $this->generateQRCodeFactory->shapingQR(),
            $data['company'] ?? null
        );
    }
}
