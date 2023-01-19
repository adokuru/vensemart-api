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
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

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

        $data = [
            "title" => $title,
            "body" => $message,
        ];


        DB::table('notifications')->insert(['user_id' => $userID, 'title' => $data['title'], 'message' => $data['message'], 'type' => 3]);


        // /************************Notification Start************/

        // $firebaseToken =  DB::table('users')->where('id', Auth::id())->whereNotNull('device_token')->pluck('device_token')->toArray();

        // $SERVER_API_KEY = 'AAAAz7uAT0o:APA91bEERv13lfoUEgsFx_Bjc8TaqxWe7hYj6QrmT4Di5AoLchYkO-oOHpmBTAo6ZMB1293LJe_LIXeZKilg_UikEeSQWyZchAyqcmlKfGrBa0IBoKjAKX9GnrCHesIo0oEnNME5nIJ8';

        // $data1 = [
        //     "registration_ids" => $firebaseToken,
        //     "notification" => [
        //         "title" => $data_dtiver['title'],
        //         "body" => $data_dtiver['message'],
        //     ]
        // ];
        // $dataString = json_encode($data1);

        // $headers = [
        //     'Authorization: key=' . $SERVER_API_KEY,
        //     'Content-Type: application/json',
        // ];

        // $url = 'https://fcm.googleapis.com/fcm/send';
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // // Disabling SSL Certificate support temporarly
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        // // Execute post
        // $result = curl_exec($ch);
        // curl_close($ch);

        // /*********************End Notification*****************/
        // DB::table('notifications')->insert(['user_id' => $data_dtiver['user_id'], 'title' => $data_dtiver['title'], 'message' => $data_dtiver['message'], 'type' => 1]);


        // $data_serviceprovider = array('title' => "New Booking", 'message' => " $bookingId New Booking Comes From the User", 'user_id' => $serviceproviderId);


        // /************************Notification Start************/

        // $firebaseTokenone =  DB::table('users')->where('id', $serviceproviderId)->whereNotNull('device_token')->pluck('device_token')->toArray();

        // $SERVER_API_KEY = 'AAAAz7uAT0o:APA91bEERv13lfoUEgsFx_Bjc8TaqxWe7hYj6QrmT4Di5AoLchYkO-oOHpmBTAo6ZMB1293LJe_LIXeZKilg_UikEeSQWyZchAyqcmlKfGrBa0IBoKjAKX9GnrCHesIo0oEnNME5nIJ8';

        // $data2 = [
        //     "registration_ids" => $firebaseTokenone,
        //     "notification" => [
        //         "title" => $data_serviceprovider['title'],
        //         "body" => $data_serviceprovider['message'],
        //     ]
        // ];
        // $dataString2 = json_encode($data2);

        // $headers = [
        //     'Authorization: key=' . $SERVER_API_KEY,
        //     'Content-Type: application/json',
        // ];

        // $url = 'https://fcm.googleapis.com/fcm/send';
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // // Disabling SSL Certificate support temporarly
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString2);
        // // Execute post
        // $result = curl_exec($ch);
        // curl_close($ch);

        // /*********************End Notification*****************/



        // DB::table('notifications')->insert(['user_id' => $data_serviceprovider['user_id'], 'title' => $data_serviceprovider['title'], 'message' => $data_serviceprovider['message'], 'type' => 3]);

        // /******************  Send notification on mail ***********************************/
        // //user

        // $get_user_data =  DB::table('users')->select('id', 'email', 'name')->where('id', Auth::id())->first();
        // if ($get_user_data) {
        //     $data['name'] = $get_user_data->name;
        //     $data['msg'] = "Service Booked : your new service booked successfully, Booking Id is " . $bookingId;
        //     $data['subject'] = "Service Booked";

        //     Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
        // }


        // //service provider

        // $getServiceProvider =  DB::table('users')->select('id', 'email', 'name')->where('id', $serviceproviderId)->first();
        // if ($getServiceProvider) {
        //     $data['name'] = $getServiceProvider->name;
        //     $data['msg'] = "New Service Recieved : your have received new  service successfully, Booking Id is " . $bookingId;
        //     $data['subject'] = "Service Recieved";
        //     Mail::to($getServiceProvider->email)->send(new \App\Mail\SendOrderMail($data));
        // }


        /***************   End *********************************************************************/
    }
}