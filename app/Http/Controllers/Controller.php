<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerifiedInfo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function sendSMSMessage($to, $message)
    {
        try {
            $client = new SMSController(env('TERMII_API_KEY'));

            $response = $client->sendMessage($to, 'N-Alert', $message, "dnd");
            return $response;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function DojahVerifyNumber($phone_number)
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'AppId' => getenv("DOJAH_APP_KEY"),
            'Authorization' => getenv("DOJAH_API_KEY")
        ])->get('https://api.dojah.io/api/v1/kyc/phone_number/basic?phone_number=' . $phone_number);
        $data = $request->json();


        if (array_key_exists('error', $data)) {
            $arr['status'] = 0;
            $arr['message'] = $data['error'];
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        $users = User::where('phone', $phone_number)->first();

        UserVerifiedInfo::create([
            'user_id' => $users->id,
            'data' => json_encode($data['entity'])
        ]);

        // get user first name from name
        $parts = explode(' ', $users->name);
        if (count($parts) > 2) {
            $first_name = $parts[0];
            $middle = $parts[1] ?? '';
            $last_name = $parts[2] ?? '';
        } else {
            $first_name = $parts[0];
            $middle = "";
            $last_name = $parts[1] ?? "";
        }
        if (strtoupper($first_name) == $data['entity']['firstName'] || $first_name == $data['entity']['lastName']) {
            $users->otp = NULL;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
        if (strtoupper($middle) == $data['entity']['firstName'] || $first_name == $data['entity']['lastName']) {
            $users->otp = NULL;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
        if (strtoupper($last_name) == $data['entity']['firstName'] || $first_name == $data['entity']['lastName']) {
            $users->otp = NULL;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            return $this->sendResponse('OTP verified successfully', []);
        }

        return $this->sendError('OTP verification failed', [], 422);
    }

    public function sendResponse($message, $result)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }



    public function sendNotification($userID, $title, $message)
    {
        try {

            $data = [
                "title" => $title,
                "body" => $message,
            ];


            DB::table('notifications')->insert(['user_id' => $userID, 'title' => $data['title'], 'message' => $data['body'], 'type' => 3]);

            $user = User::find($userID);

            if (!$user->device_token) return;

            $token = $user->device_token;

            $messaging = app('firebase.messaging');

            $notification = Notification::fromArray([
                'title' => $title,
                'body' => $message,
            ]);


            // $notification = Notification::create($title, $message);

            $message = CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData($data);

            dd($message, $messaging);

            $messaging->send($message);

            dd($notification, $token);
            // 
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}