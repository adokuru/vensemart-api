<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    public function __construct(string $api_key)
    {
        $this->key = $api_key;
    }

    private function base($url): string
    {
        return "https://api.ng.termii.com/api/{$url}";
    }

    private function checkStatus(int $status): \Illuminate\Http\JsonResponse
    {
        if ($status) {
            if ($status === 200)
                return response()->json([
                    'success' => true,
                    'message' => 'OK: Request was successful.'
                ]);
            elseif ($status === 400)
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request: Indicates that the server cannot or will not process the request due to something that is perceived to be a client error'
                ]);
            elseif ($status === 401)
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: No valid API key provided'
                ]);
            elseif ($status === 403)
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden: The API key doesn\'t have permissions to perform the request.'
                ]);
            elseif ($status === 404)
                return response()->json([
                    'success' => false,
                    'message' => 'Not Found: The requested resource doesn\'t exist.'
                ]);
            elseif ($status === 405)
                return response()->json([
                    'success' => false,
                    'message' => 'Method Not allowed: The selected http method is not allowed'
                ]);
            elseif ($status === 422)
                return response()->json([
                    'success' => false,
                    'message' => 'Unprocessable entity: indicates that the server understands the content type of the request entity, and the syntax of the request entity is correct, but it was unable to process the contained instructions'
                ]);
            elseif ($status === 429)
                return response()->json([
                    'success' => false,
                    'message' => 'Too Many Requests: Indicates the user has sent too many requests in a given amount of time'
                ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Server Errors: Something went wrong on Termii\'s end OR status was not returned'
        ]);
    }

    public function sendOTP(int $to, string $from, string $message_type, int $pin_attempts, int $pin_time_to_live, int $pin_length, string $pin_placeholder, string $message_text, string $channel = "generic"): array
    {
        $data = [
            "api_key" => $this->key,
            "to" => $to,
            "from" => $from,
            "message_type" => $message_type,
            "channel" => $channel,
            "pin_attempts" => $pin_attempts,
            "pin_time_to_live" => $pin_time_to_live,
            "pin_length" => $pin_length,
            "pin_placeholder" => $pin_placeholder,
            "message_text" => $message_text
        ];
        $request = Http::post($this->base("sms/otp/send"), $data);
        $status = $request->status();

        if (json_decode($this->checkStatus($status)->content())->success || $status === 400) {
            return [
                'status' => $request->status(),
                'data' =>  $request->json()
            ];
        }
        return $this->checkStatus($status)->content();
    }


    public function verifyOTP(string $pinId, string $pin): array
    {
        $data = [
            "api_key" => $this->key,
            "pin_id" => $pinId,
            "pin" => $pin,
        ];

        $request = Http::post($this->base("sms/otp/verify"), $data);
        $status = $request->status();

        if (json_decode($this->checkStatus($status)->content())->success || $status === 400) {
            return [
                'status' => $request->status(),
                'data' =>  $request->json()
            ];
        }
        return $this->checkStatus($status)->content();
    }


    /*
	* Method name: sendMessage.
	* Description: Send Message.
	* params: to, from, sms, channel, media, media_url, media_caption.
	*/
    public function sendMessage(int $to, string $from, string $sms, string $channel = "generic", bool $media = false, string $media_url = null, string $media_caption = null): string
    {
        $type = "plain";

        if ($media == true && $channel == "whatsapp") {
            $channel = "whatsapp";

            $data = [
                "api_key" => $this->key,
                "to" => $to,
                "from" => $from,
                "type" => $type,
                "channel" => $channel,
                "media" => json_encode([
                    "media.url" => $media_url,
                    "media.caption" => $media_caption
                ])
            ];
        }

        $data = [
            "api_key" => $this->key,
            "to" => $to,
            "from" => $from,
            "sms" => $sms,
            "type" => $type,
            "channel" => $channel
        ];

        $request = Http::post($this->base("sms/send"), $data);
        $status = $request->status();
        if (json_decode($this->checkStatus($status)->content())->success || $status === 400) {
            return $request->getBody()->getContents();
        }
        return $this->checkStatus($status)->content();
    }
}