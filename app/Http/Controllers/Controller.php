<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendSMSMessage($to, $message)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);

        $client->messages->create(
            $to,
            [
                'messagingServiceSid' => "MG3512c03318494f73440b3462631d1c86",
                'body' => $message
            ]
        );

        return true;
    }
}