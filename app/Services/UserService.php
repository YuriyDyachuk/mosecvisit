<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserService
{
    private SmsService $smsService;

    public function __construct(
        SmsService $smsService
    ){
        $this->smsService = $smsService;
    }

    public function sendCode(User $user): void
    {
        DB::beginTransaction();

        try {
            $code = $this->createCode();
            $user->verify()->create(['code' => $code]);
           // $this->smsService->send($code, $user->phone);
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
        }

    }

    public function createLogin(): string
    {
        /* Generation do/while - exists unique for login User */
        return Str::random(15);
    }

    private function createCode(): int
    {
        return 111111;  // rand(10**5,10**6);
    }

    public function createQrCode(User $user): void
    {

        $fileName = md5($user->login) . '.png';

        if (Storage::disk('qr')->exists($user->link_qrcode)) {
            Storage::disk('qr')->delete($user->link_qrcode);
        }

        QrCode::format('png')
            ->size(150)
            ->errorCorrection('H')
            ->backgroundColor(11, 127, 171)
            ->generate(
                'http://localhost:3001/api/v1/users/get-by-qr/' . $user->login,
                storage_path('app/public/qr/' . $fileName)
            );

        $user->update(['link_qrcode' => $fileName]);
    }

}
