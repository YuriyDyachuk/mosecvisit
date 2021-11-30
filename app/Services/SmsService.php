<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Response;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SmsService
{

    /**
     * @throws TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function send(int $code, string $phone)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $numberFrom = env('TWILIO_FROM');

        $twilio = new Client($sid, $token);

        try {
            $twilio->messages
                ->create($phone, [
                        'from' => $numberFrom,
                        'body' => "Your sms code - $code"
                    ]
                );
        } catch (TwilioException $e) {
            throw new TwilioException('Phone number is not found', Response::HTTP_BAD_REQUEST);
        }
    }
}
