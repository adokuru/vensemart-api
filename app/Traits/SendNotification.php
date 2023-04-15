<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

//use App\Models\User;
trait SendNotification
{


    function send_to_user($data)
    {

        $firebaseToken =  DB::table('users')->where('id', $data['user_id'])->whereNotNull('device_token')->pluck('device_token')->toArray();

        $SERVER_API_KEY = 'AAAAz7uAT0o:APA91bEERv13lfoUEgsFx_Bjc8TaqxWe7hYj6QrmT4Di5AoLchYkO-oOHpmBTAo6ZMB1293LJe_LIXeZKilg_UikEeSQWyZchAyqcmlKfGrBa0IBoKjAKX9GnrCHesIo0oEnNME5nIJ8';

        $data1 = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $data['title'],
                "body" => $data['message'],
            ]
        ];
        $dataString = json_encode($data1);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $url = 'https://fcm.googleapis.com/fcm/send';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        // Execute post
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }
}
