<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserService
{
    private SmsService $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendCode(User $user): void
    {
        DB::beginTransaction();

        try {
            $code = $this->createCode();
            $user->verify()->create(['code' => $code]);
            $this->smsService->send($code, $user->phone);
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
        }

    }

    public function createLogin(): string
    {
        return Str::random(15);
    }

    private function createCode(): int
    {
        return rand(10**5,10**6);
    }

    public function createQrCode(User $user): void
    {
        //тут создать qr code
    }
}
