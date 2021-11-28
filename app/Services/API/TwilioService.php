<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Models\User;
use Twilio\Rest\Client;

class TwilioService
{
    /**
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function messageTo(int $code, User $user)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $numberFrom = env('TWILIO_FROM');

        $twilio = new Client($sid, $token);
        $twilio->messages
            ->create($user->phone, [
                    'from' => $numberFrom,
                    'body' => "Your sms code - $code"
                ]
            );
    }
}
