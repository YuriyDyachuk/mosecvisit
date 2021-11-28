<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Repositories\API\User\UserQrRepository;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserQrCodeService
{
    /**
     * @var UserQrRepository
     */
    protected UserQrRepository $userQrRepository;

    public function __construct(UserQrRepository $userQrRepository)
    {
        $this->userQrRepository = $userQrRepository;
    }

    public function generation(string $login, int $userId): void
    {
        $fileName = md5($login) . '.png';

        if (Storage::disk('qr')->exists($fileName)) {
            Storage::disk('qr')->delete($fileName);
        }

        QrCode::format('png')
            ->size(150)
            ->errorCorrection('H')
            ->backgroundColor(11, 127, 171)
            ->generate(
                'http://localhost:3001/api/v1/users/get-by-qr/' . $login,
                storage_path('app/public/qr/' . $fileName)
            );

        $link = Storage::disk('qr')->url($fileName);

        $this->userQrRepository->create($link, $userId);
    }
}
