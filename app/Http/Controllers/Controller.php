<?php

namespace App\Http\Controllers;

use App\Models\ServicebookUser;
use App\Models\User;
use App\Models\UserVerifiedInfo;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


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


    public function validateNumber($phone_number)
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

        $users = User::where('mobile', $phone_number)->first();

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
            $users->is_online = 1;
            $users->status = 1;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            UserVerifiedInfo::create([
                'user_id' => $users->id,
                'data' => json_encode($data['entity'])
            ]);
            return response()->json($arr, 200);
        }
        if (strtoupper($middle) == $data['entity']['firstName'] || $first_name == $data['entity']['lastName']) {
            $users->is_online = 1;
            $users->status = 1;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            UserVerifiedInfo::create([
                'user_id' => $users->id,
                'data' => json_encode($data['entity'])
            ]);
            return response()->json($arr, 200);
        }
        if (strtoupper($last_name) == $data['entity']['firstName'] || $first_name == $data['entity']['lastName']) {
            $users->is_online = 1;
            $users->status = 1;
            $users->is_phone_verified = 1;
            $users->save();
            $arr['status'] = 1;
            $arr['message'] = 'OTP verified successfully';
            $arr['data'] = NULL;
            UserVerifiedInfo::create([
                'user_id' => $users->id,
                'data' => json_encode($data['entity'])
            ]);
            return $this->sendResponse('verified successfully', []);
        }

        return $this->sendError('verification failed', [], 422);
    }

    public function sendResponse($message, $result = null)
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


            \OneSignal::sendNotificationToUser($message, $token, $url = null, $data = null);

            /*********************End Notification*****************/
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function calculateLevelForServiceProvider($serviceProviderID)
    {
        try {

            $bronze = 5;
            $silver = 15;
            $gold = 30;
            $platinum = 50;
            $diamond = 75;


            $serviceProvider = ServicebookUser::where("service_pro_id", $serviceProviderID)->where("rating", "=", 5)->get();

            $total = count($serviceProvider);

            if ($total >= $bronze && $total < $silver) {
                $level = "Bronze";
            } elseif ($total >= $silver && $total < $gold) {
                $level = "Silver";
            } elseif ($total >= $gold && $total < $platinum) {
                $level = "Gold";
            } elseif ($total >= $platinum && $total < $diamond) {
                $level = "Platinum";
            } elseif ($total >= $diamond) {
                $level = "Diamond";
            } else {
                $level = "Bronze";
            }

            return $level;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function deleteUserAccount($userID)
    {
        try {
            $user = User::find($userID);
            $user->delete();
            return $this->sendResponse('User deleted successfully', []);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function contactRiderAndVendor(Request $request)
    {


        $orderID = $request->orderID;
        $customerID = $request->customerID;

        try {
            $orderDetails = \App\Models\EshopPurchaseDetail::where('order_id', $orderID)->first();
            $customer = User::where('id', $customerID)->first();



            if (!$orderDetails) return $this->sendError('Order not found', [], 422);

            if (!$customer) return $this->sendError('Customer not found', [], 422);


            $data = [
                "title" => "Contact Rider",
                "body" => "Customer " . $customer->name . " wants to contact you for order " . $orderDetails->order_id,
            ];

            $vendorNotification = [
                "title" => "Contact Vendor",
                "body" => "A Customer " . $customer->name . " wants to contact you for order " . $orderDetails->order_id . ", a rider will contact you soon, please visit your order details for more information.",
            ];


            $product = \App\Models\Products::find($orderDetails->product_id);

            if (!$product) return $this->sendError('Product not found', [], 422);

            $vendor = $this->getVendor($product->shop_id);


            return $this->requestRiderForDelivery($vendor->lati, $vendor->longi, $orderDetails);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function requestRiderForDelivery($lat, $lng, $order)
    {
        // get all rider within 5km
        $rider = User::where('type', 2)->get();

        return $rider;
        $riderArray = [];

        foreach ($rider as $key => $value) {
            if ($value->location_lat == null || $value->location_long == null) continue;
            $distance = $this->getDistance($lat, $lng, $value->location_lat, $value->location_long);
            // add distance in array
            $value->distance = $distance;

            // order by distance
            $riderArray[] = $value;
        }

        array_multisort(array_column($riderArray, 'distance'), SORT_ASC, $riderArray);

        return $this->sendResponse('Rider found', $riderArray);
    }


    // get distance between two points with google map api
    public function getDistance($lat, $lng, $lati, $longi)
    {
        // get distance and duration between two points with google api
        $lat1 = $lati;
        $lon1 = $longi;
        $lat2 = $lng;
        $lon2 = $lat;
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $lon1 . "&destinations=" . $lat2 . "," . $lon2 . "&mode=driving&units=imperial&key=" . env('GOOGLE_MAP_API_KEY');
        $client = new Client();
        $res = $client->get($url);
        $data = json_decode($res->getBody(), true);
        $distance = $data ? $data["rows"][0]["elements"][0]["distance"]["value"] / 1000 : 1;
        return $distance;
    }


    public function getVendor($shopID)
    {
        try {
            $vendor = \App\Models\Stores::where('id', $shopID)->first();
            return $vendor;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
