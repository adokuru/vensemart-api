<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ServicePlanPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ServiceProviderController extends Controller
{

    public function serviceprovider_onboarding(Request $request)
    {
        try {
            $typevalidate = Validator::make($request->all(), [
                'service_type_id' => 'required',
            ]);

            if ($typevalidate->fails()) {
                return response()->json([
                    'success' => 0,
                    'message' => $typevalidate->errors()->first(),
                    'data' => null
                ]);
            }

            $userid = Auth::id();

            $user = User::find($userid);

            $user->service_type = $request->service_type_id;

            $user->save();

            return response()->json([
                'success' => 1,
                'message' => 'Service provider onboarding successful',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }
    public function serviceprovider_onboarding_2(Request $request)
    {
        try {
            $typevalidate = Validator::make($request->all(), [
                'location' => 'required',
                'location_lat' => 'required',
                'location_long' => 'required',
            ]);

            if ($typevalidate->fails()) {
                return response()->json([
                    'success' => 0,
                    'message' => $typevalidate->errors()->first(),
                    'data' => null
                ]);
            }

            $userid = Auth::id();

            $user = User::find($userid);

            $user->location = $request->location;
            $user->location_lat = $request->location_lat;
            $user->location_long = $request->location_long;

            $user->save();

            return response()->json([
                'success' => 1,
                'message' => 'Service provider location onboarding successful',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function homeservice(Request $request)
    {
        $userid = Auth::id();
        $latitude = $request->latitude;
        $longtitude = $request->longtitude;
        try {
            $data['banners'] = DB::table('serviceprovider_banners')->where('status', 1)->get();

            $data['services'] = DB::table('users')
                ->select(
                    'serviceprovider_category.id as category_id',
                    'serviceprovider_category.*',
                    'users.id as service_providerid',
                    DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
                             * cos(radians(users.location_lat)) 
                             * cos(radians(users.location_long) - radians(" . $request->longtitude . ")) 
                             + sin(radians(" . $request->latitude . ")) 
                             * sin(radians(users.location_lat))) AS distance")
                )
                ->having('distance', '<', '20')
                ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'users.service_type')
                ->where('users.status', 1)
                ->where('users.type', 3)
                ->where('users.gps_location_status', "1") //for gps location on  
                ->groupBy('serviceprovider_category.id')
                ->limit(6)
                ->get();

            foreach ($data['services'] as $val) {
                $val->category_icon = $val->category_icon ? url('storage/app/category_icons') . '/' . $val->category_icon : '';
            }

            if (!empty($data['banners'][0])) {

                foreach ($data['banners'] as $val) {
                    $val->image = $val->image ? url('uploads/serviceprovider_banners') . '/' . $val->image : '';
                }

                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'NO Data Found';
                $arr['data'] = NULL;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }

    public function homeServiceProvider()
    {
        try {
            $userid = Auth::id();



            $pending_requests = DB::table('servicebook_user')
                ->where('servicebook_user.status', 1)
                ->where('servicebook_user.service_pro_id', $userid)
                ->count();
            $completed_requests = DB::table('servicebook_user')
                ->where('servicebook_user.status', 3)
                ->where('servicebook_user.service_pro_id', $userid)
                ->count();
            $cancelled_requests = DB::table('servicebook_user')
                ->where('servicebook_user.status', 5)
                ->where('servicebook_user.service_pro_id', $userid)
                ->count();
            $total_requests = DB::table('servicebook_user')
                ->where('servicebook_user.service_pro_id', $userid)
                ->count();


            $data['pending_requests'] = $pending_requests;
            $data['completed_requests'] = $completed_requests;
            $data['cancelled_requests'] = $cancelled_requests;
            $data['total_requests'] = $total_requests;

            $requests = DB::table('servicebook_user')
                ->where('servicebook_user.status', 1)
                ->where('servicebook_user.service_pro_id', $userid)
                ->get()
                ->toArray();

            $data['requests'] = $requests;


            return response()->json([
                'success' => 1,
                'message' => 'Service provider home page data',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function service_provider_by_ID($id)
    {
        $data = DB::table('users as u')
            ->select(
                "u.name",
                "u.id",
                "u.service_type",
                "u.location_lat",
                "u.location_long",
                "u.mobile as phone",
                "u.profile",
                "u.service_type",
                "serviceprovider_category.category_name",
                "serviceprovider_category.category_icon",
                "u.location",
                "u.service_type_price",
            )
            ->where('u.id', $id)
            ->join('serviceprovider_category', 'serviceprovider_category.id', '=', 'u.service_type')
            ->first();

        $data->service_category = DB::table('serviceprovider_category')->where('id', $data->service_type)->first();


        if (!$data) {
            return response()->json([
                'success' => 0,
                'message' => 'No data found',
                'data' => null
            ]);
        }

        $data->service_provider_image = $data->profile ? url('uploads/profile') . '/' . $data->profile : '';

        $data->service_provider_rating = DB::table('servicebook_user')
            ->where('service_pro_id', $id)
            ->avg('rating');

        $data->service_provider_rating = $data->service_provider_rating ? $data->service_provider_rating : 0;

        return response()->json([
            'success' => 1,
            'message' => 'Service provider details',
            'data' => $data
        ]);
    }

    public function serviceprovider_list(Request $request, $cat_id)
    {
        $categoryId = $cat_id;
        $userId = Auth::id();

        $user = User::where('id', $userId)->first();

        if (!$user) {
            return response()->json([
                'success' => 0,
                'message' => 'User not found',
                'data' => null
            ], 422);
        }

        if ($user->location_lat == null || $user->location_long == null) {
            return response()->json([
                'success' => 0,
                'message' => 'Please update your location',
                'data' => null
            ], 422);
        }

        $lat = $user->location_lat;
        $lng = $user->location_long;

        try {
            $data = DB::table('users')
                ->select(
                    "users.name",
                    "users.id",
                    "users.service_type",
                    "users.location_lat",
                    "users.location_long",
                    "users.profile",
                    "users.service_type",
                    "serviceprovider_category.category_name",
                    "serviceprovider_category.category_icon",
                    "users.location",
                    "users.service_type_price",
                    DB::raw('CONCAT("' . url('uploads/profile') . '","/",profile)  as service_provider_image'),
                    DB::raw("6371 * acos(cos(radians(" . $lat . "))
                             * cos(radians(users.location_lat)) 
                             * cos(radians(users.location_long) - radians(" . $lng . ")) 
                             + sin(radians(" . $lat . ")) 
                             * sin(radians(users.location_lat))) AS distance")
                )
                ->join('serviceprovider_category', 'serviceprovider_category.id', '=', 'users.service_type')
                ->where('users.service_type', $categoryId)
                // ->where('status', 1)
                ->orderBy('distance', 'asc')
                ->get();


            foreach ($data as $key => $value) {
                $data[$key]->profile = $value->profile ? url('uploads/profile/' . $value->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
            }

            foreach ($data as $val) {
                $val->service_category = DB::table('serviceprovider_category')->where('id', $val->service_type)->first();
                $val->service_provider_rating = DB::table('servicebook_user')
                    ->where('service_pro_id', $val->id)
                    ->avg('rating');
            }


            if (!empty($data[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function allserviceslist_old(Request $request)
    {

        try {
            $data = DB::table('serviceprovider_serviceslist')
                ->select(
                    'serviceprovider_category.id as category_id',
                    'serviceprovider_category.*',
                    DB::raw('CONCAT("' . url('uploads/serviceprovider_services_images') . '","/",category_icon)  as category_icon'),
                    DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
                             * cos(radians(serviceprovider_serviceslist.latitude)) 
                             * cos(radians(serviceprovider_serviceslist.longtitude) - radians(" . $request->longtitude . ")) 
                             + sin(radians(" . $request->latitude . ")) 
                             * sin(radians(serviceprovider_serviceslist.latitude))) AS distance")
                )
                ->having('distance', '<', '20')
                ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'serviceprovider_serviceslist.service_categoryid')
                ->where('status', 1)

                ->get();
            if (!empty($data[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    // 23/09  new created
    public function allserviceslist()
    {

        try {
            $data  = DB::table('serviceprovider_category')->select('serviceprovider_category.*', 'serviceprovider_category.id as category_id')->get();

            foreach ($data as $val) {
                $val->category_icon = $val->category_icon ? url('storage/app/category_icons') . '/' . $val->category_icon : '';
            }
            if (!empty($data[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function paymentbookingservice(Request $request)
    {
        $userId = Auth::id();
        $serviceproviderId = $request->service_provider_id;
        $price = $request->price;
        $bookingId = 'BOOK' . rand(1000, 9999);
        $time = $request->booking_time;
        $date = $request->booking_date;
        $servicetype = $request->service_type;
        $userlat = $request->user_lat;
        $userlong = $request->user_long;
        $useraddress = $request->user_address;
        $description = $request->description;
        $paymentstatus = $request->payment_status;
        $transactionId = $request->transaction_id;
        $payment_mode = $request->payment_mode;
        $mobilenumber = $request->mobile_number;

        try {
            $data = array(
                'user_id' => $userId,
                'service_pro_id' => $serviceproviderId,
                'booking_id' => $bookingId,
                'user_lat' => $userlat,
                'user_long' => $userlong,
                'price' => $price,
                'booking_date' => $date,
                'booking_time' => $time,
                'service_type' => $servicetype,
                'user_address' => $useraddress,
                'description' => $description,
                'payment_status' => $paymentstatus,
                'transaction_id' => $transactionId,
                'payment_mode' => $payment_mode,
                'mobile_number' => $mobilenumber
            );

            $d = DB::table('servicebook_user')->insert($data);

            $data_dtiver = array('title' => "Booking", 'message' => "Booking Was Successfully Submitted", 'user_id' => Auth::id());

            /************************Notification Start************/

            $firebaseToken =  DB::table('users')->where('id', Auth::id())->whereNotNull('device_token')->pluck('device_token')->toArray();

            $SERVER_API_KEY = 'AAAAz7uAT0o:APA91bEERv13lfoUEgsFx_Bjc8TaqxWe7hYj6QrmT4Di5AoLchYkO-oOHpmBTAo6ZMB1293LJe_LIXeZKilg_UikEeSQWyZchAyqcmlKfGrBa0IBoKjAKX9GnrCHesIo0oEnNME5nIJ8';

            $data1 = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => $data_dtiver['title'],
                    "body" => $data_dtiver['message'],
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
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            // Execute post
            $result = curl_exec($ch);
            curl_close($ch);

            /*********************End Notification*****************/
            DB::table('notifications')->insert(['user_id' => $data_dtiver['user_id'], 'title' => $data_dtiver['title'], 'message' => $data_dtiver['message'], 'type' => 1]);


            $data_serviceprovider = array('title' => "New Booking", 'message' => " $bookingId New Booking Comes From the User", 'user_id' => $serviceproviderId);


            /************************Notification Start************/

            $firebaseTokenone =  DB::table('users')->where('id', $serviceproviderId)->whereNotNull('device_token')->pluck('device_token')->toArray();

            $SERVER_API_KEY = 'AAAAz7uAT0o:APA91bEERv13lfoUEgsFx_Bjc8TaqxWe7hYj6QrmT4Di5AoLchYkO-oOHpmBTAo6ZMB1293LJe_LIXeZKilg_UikEeSQWyZchAyqcmlKfGrBa0IBoKjAKX9GnrCHesIo0oEnNME5nIJ8';

            $data2 = [
                "registration_ids" => $firebaseTokenone,
                "notification" => [
                    "title" => $data_serviceprovider['title'],
                    "body" => $data_serviceprovider['message'],
                ]
            ];
            $dataString2 = json_encode($data2);

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
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString2);
            // Execute post
            $result = curl_exec($ch);
            curl_close($ch);

            /*********************End Notification*****************/



            DB::table('notifications')->insert(['user_id' => $data_serviceprovider['user_id'], 'title' => $data_serviceprovider['title'], 'message' => $data_serviceprovider['message'], 'type' => 3]);





            if ($d > 0) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $d;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Failed';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function bookingservice(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$user) {
            $arr['status'] = 0;
            $arr['message'] = 'User not found';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        if (!$request->service_provider_id) {
            $arr['status'] = 0;
            $arr['message'] = 'Service Provider Id is required';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }
        $serviceProvider = User::find($request->service_provider_id);

        if (!$serviceProvider) {
            $arr['status'] = 0;
            $arr['message'] = 'Service Provider not found';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        $serviceproviderId = $request->service_provider_id;
        $price = 100;
        $bookingId = 'BOOK' . rand(10000, 9999999);
        $time = $request->booking_time;
        $date = $request->booking_date;
        $servicetype = $serviceProvider->service_type;
        $userlat = $user->location_lat;
        $userlong = $user->location_long;
        $useraddress = $user->location;



        try {
            $data = array(
                'user_id' => $userId,
                'service_pro_id' => $serviceproviderId,
                'booking_id' => $bookingId,
                'user_lat' => $userlat,
                'user_long' => $userlong,
                'price' => $price,
                'booking_date' => $date,
                'booking_time' => $time,
                'service_type' => $servicetype,
                'user_address' => $useraddress,
            );

            $d = DB::table('servicebook_user')->insert($data);

            $this->sendNotification(Auth::id(), "Booking", "Booking Was Successfully Submitted");
            $this->sendNotification($data['service_pro_id'], "Booking", "New Booking Request From"  . $user->name);

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $d;
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function trendingServices(Request $request)
    {
        try {

            if ($request->lat && $request->long) {
                $lat = $request->lat;
                $long = $request->long;


                $data = DB::table('users')
                    ->select(
                        "users.name",
                        "users.id",
                        "users.service_type",
                        "users.location_lat",
                        "users.location_long",
                        "users.profile",
                        "users.service_type",
                        "serviceprovider_category.category_name",
                        "serviceprovider_category.category_icon",
                        "users.location",
                        "users.service_type_price",
                        DB::raw("6371 * acos(cos(radians(" . $lat . "))
                        * cos(radians(users.location_lat)) 
                        * cos(radians(users.location_long) - radians(" . $long . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(users.location_lat))) AS distance"),
                        DB::raw("COUNT(servicebook_user.id) as booking_count")
                    )
                    ->where('users.type', 3)
                    ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'users.service_type')
                    ->leftJoin('servicebook_user', 'servicebook_user.service_pro_id', '=', 'users.id')
                    ->orderBy('distance', 'asc')
                    ->orderBy('booking_count', 'desc')
                    ->limit(8)
                    ->get(8);

                foreach ($data as $key => $value) {
                    $data[$key]->profile = $value->profile ? url('uploads/profile/' . $value->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
                }


                //  check booking count 

                foreach ($data as $key => $value) {
                    $data[$key]->booking_count = DB::table('servicebook_user')->where('service_pro_id', $value->id)->where('status', 2)->count();
                }


                $result = array();

                foreach ($data as $key => $value) {
                    $result[$key]['id'] = $value->id;
                    $result[$key]['name'] = $value->name;
                    $result[$key]['service_type'] = $value->service_type;
                    $result[$key]['location_lat'] = $value->location_lat;
                    $result[$key]['location_long'] = $value->location_long;
                    $result[$key]['profile'] = $value->profile;
                    $result[$key]['service_type'] = $value->service_type;
                    $result[$key]['category_name'] = $value->category_name;
                    $result[$key]['category_icon'] = $value->category_icon;
                    $result[$key]['location'] = $value->location;
                    $result[$key]['service_type_price'] = $value->service_type_price;
                    $result[$key]['distance'] = $value->distance;
                    $result[$key]['booking_count'] = $value->booking_count;
                }

                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $result;


                return response()->json($arr, 200);
            }


            $data = DB::table('users')
                ->select(
                    "users.name",
                    "users.id",
                    "users.service_type",
                    "users.location_lat",
                    "users.location_long",
                    "users.profile",
                    "users.service_type",
                    "serviceprovider_category.category_name",
                    "serviceprovider_category.category_icon",
                    "users.location",
                    "users.service_type_price",
                    "servicebook_user.status",
                )
                ->where('users.type', 3)
                ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'users.service_type')
                ->leftJoin('servicebook_user', 'servicebook_user.service_pro_id', '=', 'users.id')
                ->get();



            foreach ($data as $key => $value) {
                $data[$key]->profile = $value->profile ? url('uploads/profile/' . $value->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
            }


            foreach ($data as $key => $value) {
                $data[$key]->booking_count = DB::table('servicebook_user')->where('service_pro_id', $value->id)->where('status', 2)->count();
            }

            // order by booking count

            $result = array();

            foreach ($data as $key => $value) {
                $result[$key]['id'] = $value->id;
                $result[$key]['name'] = $value->name;
                $result[$key]['service_type'] = $value->service_type;
                $result[$key]['location_lat'] = $value->location_lat;
                $result[$key]['location_long'] = $value->location_long;
                $result[$key]['profile'] = $value->profile;
                $result[$key]['service_type'] = $value->service_type;
                $result[$key]['category_name'] = $value->category_name;
                $result[$key]['category_icon'] = $value->category_icon;
                $result[$key]['location'] = $value->location;
                $result[$key]['service_type_price'] = $value->service_type_price;
                $result[$key]['booking_count'] = $value->booking_count;
            }


            // order by $result['booking_count'] desc

            usort($result, function ($a, $b) {
                return $b['booking_count'] <=> $a['booking_count'];
            });

            // get only the first 10

            $result = array_slice($result, 0, 10);



            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $result;

            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;

            return response()->json($arr, 500);
        }
    }

    public function bookingsservicelist($booking_type)
    {
        $type = $booking_type;

        /*
        1=Upcoming Booking
        2=Completed Booking
        5=Cancel Booking
        */
        try {
            if ($type == "1") {

                $date_n =  \Carbon\Carbon::now()->startOfDay()->format('d-n-Y');

                // return $date_n;
                $data = DB::table('servicebook_user')
                    ->select('servicebook_user.*', 'users.location', 'users.profile as profile', 'users.name', 'users.mobile', 'serviceprovider_category.category_icon as icon', 'serviceprovider_category.category_name as category_name')
                    ->leftJoin('users', 'users.id', '=', 'servicebook_user.service_pro_id')
                    ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'servicebook_user.service_type')
                    ->where('servicebook_user.user_id', Auth::id())
                    ->where(function ($query) use ($date_n) {
                        $query->where('servicebook_user.status', 1)
                            ->orWhere('servicebook_user.status', 2);
                    })
                    ->orderBy('servicebook_user.id', 'desc')
                    ->get();

                if (!empty($data[0])) {
                    foreach ($data as $key =>  $val) {
                        $data[$key]->profile = $val->profile ? url('uploads/profile/' . $val->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
                    }
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $data;
                } else {
                    $arr['status'] = 1;
                    $arr['message'] = 'No Data found';
                    $arr['data'] = [];
                }
            }
            if ($type == "2") {
                $data = DB::table('servicebook_user')
                    ->select('servicebook_user.*', 'users.location', 'users.profile as profile', 'users.name', 'users.mobile', 'serviceprovider_category.category_icon as icon', 'serviceprovider_category.category_name as category_name')
                    ->leftJoin('users', 'users.id', '=', 'servicebook_user.service_pro_id')
                    ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'servicebook_user.service_type')
                    ->where('servicebook_user.status', 3)
                    ->where('servicebook_user.user_id', Auth::id())
                    ->orderBy('servicebook_user.id', 'desc')
                    ->get();
                if (!empty($data[0])) {
                    foreach ($data as $key =>  $val) {
                        $data[$key]->profile = $val->profile ? url('uploads/profile/' . $val->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
                    }
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $data;
                } else {
                    $arr['status'] = 1;
                    $arr['message'] = 'No Data found';
                    $arr['data'] = [];
                }
            }
            if ($type == "3") {

                $data = DB::table('servicebook_user')
                    ->select('servicebook_user.*', 'users.location', 'users.profile as profile', 'users.name', 'users.mobile', 'serviceprovider_category.category_icon as icon', 'serviceprovider_category.category_name as category_name')
                    ->leftJoin('users', 'users.id', '=', 'servicebook_user.service_pro_id')
                    ->leftJoin('serviceprovider_category', 'serviceprovider_category.id', '=', 'servicebook_user.service_type')
                    ->where('servicebook_user.status', 5)
                    ->where('servicebook_user.user_id', Auth::id())
                    ->orderBy('servicebook_user.id', 'desc')
                    ->get();
                if (!empty($data[0])) {
                    foreach ($data as $key =>  $val) {
                        $data[$key]->profile = $val->profile ? url('uploads/profile/' . $val->profile) : "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
                    }
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $data;
                } else {
                    $arr['status'] = 1;
                    $arr['message'] = 'No Data found';
                    $arr['data'] = [];
                }
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
        return response()->json($arr, 200);
    }
    public function cancelbooking(Request $request)
    {
        $userId = Auth::id();
        $bookingId = $request->booking_id;
        $cancelreason = $request->cancel_reason;
        try {
            $data = array('cancel_reasons' => $cancelreason, 'status' => 5);
            $update = DB::table('servicebook_user')->where('id', $bookingId)->update($data);

            if ($update) {
                $arr['status'] = 1;
                $arr['message'] = 'Booking Cancelled Successfully';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Booking Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function cancelreasonlist()
    {
        try {
            $data = DB::table('cancel_reason')->get();
            if (!empty($data[0])) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Cancel Reason Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    public function searchserviceprovider_old(Request $request)
    {
        $keyword = $request->keyword;
        try {
            $data = DB::table('serviceprovider_category as sc')->select('sc.category_name', 'sc.category_icon', 'ss.*', 'ss.id as ss_serviceprovider_service_id')
                ->join('serviceprovider_serviceslist as ss', 'ss.service_categoryid', 'sc.id')
                // ->join('stores as s','s.id','p.shop_id')
                // ->join('uom as u','u.id','p.uom_id')
                // ->whereIn('shop_id',$shop_ids)
                ->where(function ($query) use ($keyword) {
                    $query->where('sc.category_name', 'LIKE', '%' . $keyword . '%');
                    // ->orWhere('p.product_title', 'LIKE', '%'.$keyword.'%')
                    // ->orWhere('p.product_description', 'LIKE', '%'.$keyword.'%');
                })
                ->orderBy('id', 'desc')
                ->get();
            if (!empty($data[0])) {
                foreach ($data as $val) {
                    $val->image = $val->image ? url('uploads/serviceprovider_stores_images') . '/' . $val->image : '';
                }
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $data;
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    //  23/09/22
    public function searchserviceprovider(Request $request)
    {
        $keyword = $request->keyword;
        try {
            $data = DB::table('serviceprovider_category as sc')->select('sc.*')
                ->where(function ($query) use ($keyword) {
                    $query->where('sc.category_name', 'LIKE', '%' . $keyword . '%');
                })->get();
            if (count($data) > 0) {
                foreach ($data as $val) {
                    $val->image = url('storage/app/category_icons') . '/' . $val->category_icon;
                }
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    public function service_type(Request $request)
    {

        $get_service_type = DB::table('serviceprovider_category')->select('*')->get()->toArray();
        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function receved_request_list(Request $request)
    {

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('serviceprovider_category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 1)
            ->where('su.service_pro_id', Auth::id())
            ->get()
            ->toArray();

        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }


    public function upcomming_request_list(Request $request)
    {

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.service_pro_id', Auth::id())
            ->where(function ($query) {
                return $query
                    ->where('su.status', 2)
                    ->orWhere('su.status', 1);
            })
            ->get()
            ->toArray();

        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }

    public function receved_request_detail(Request $request)
    {
        $arr = [];
        $typevalidate = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 2)
            ->where('su.service_pro_id', Auth::id())
            ->where('su.id', $request->id)
            ->first();


        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        return response()->json($arr, 200);
    }


    public function upcomming_request_detail(Request $request)
    {
        $arr = [];
        $typevalidate = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 1)
            ->where('su.service_pro_id', Auth::id())
            ->where('su.id', $request->id)
            ->first();


        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        return response()->json($arr, 200);
    }


    public function cancel_request_list(Request $request)
    {

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 5)
            ->where('su.service_pro_id', Auth::id())
            ->get()
            ->toArray();

        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function complete_request_list(Request $request)
    {

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 3)
            ->where('su.service_pro_id', Auth::id())
            ->get()
            ->toArray();

        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }



    public function cancel_request_detail(Request $request)
    {
        $arr = [];
        $typevalidate = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 5)
            ->where('su.service_pro_id', Auth::id())
            ->where('su.id', $request->id)
            ->first();


        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        return response()->json($arr, 200);
    }


    public function complete_request_detail(Request $request)
    {
        $arr = [];
        $typevalidate = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 3)
            ->where('su.service_pro_id', Auth::id())
            ->where('su.id', $request->id)
            ->first();


        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        return response()->json($arr, 200);
    }


    public function confirm_request_list(Request $request)
    {


        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 3)
            ->where('su.service_pro_id', Auth::id())
            ->get()
            ->toArray();

        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function confirm_request_detail(Request $request)
    {
        $arr = [];
        $typevalidate = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
        $get_service_type = DB::table('servicebook_user as su')
            ->select('su.*', 'u.name', 'u.email', 'u.mobile', 'c.category_name')
            ->join('users as u', 'u.id', '=', 'su.user_id')
            ->join('category as c', 'c.id', '=', 'su.service_type')
            ->where('su.status', 3)
            ->where('su.service_pro_id', Auth::id())
            ->where('su.id', $request->id)
            ->first();


        if (!empty($get_service_type)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_service_type;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'No Data found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        return response()->json($arr, 200);
    }
    public function get_profile(Request $request)
    {
        $arr = [];

        try {
            // print_r(Auth::id());die;
            $profile = Auth::user();
            $profile->profile = $profile->profile ? url('uploads/profile') . '/' . $profile->profile : '';
            $profile->id_prof = $profile->id_prof ? url('uploads/id_prof') . '/' . $profile->id_prof : '';
            $profile->level = $this->calculateLevelForServiceProvider($profile->id);


            if ($profile) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $profile;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Something went wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    public function service_update_profile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required'

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        try {
            $user = User::find(Auth::id());



            $insert['name'] = $request->name;
            $insert['email'] = $request->email || $user->email;
            $insert['mobile'] = $request->mobile_number || $user->mobile;
            $insert['location'] = $request->address || $user->location;
            $insert['location_lat'] = $request->address_lat || $user->location_lat;
            $insert['location_long'] = $request->address_long || $user->location_long;

            if (!empty($request->profile)) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('profile')->getClientOriginalName();
                $store = $request->file('profile')->move('uploads/profile', $file_name);
                if ($store) {
                    $insert['profile'] = $file_name;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Profile image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            if (!empty($request->email)) {
                $email = User::where('id', '!=', Auth::id())->where('email', $request->email)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Email already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            if (!empty($request->mobile)) {
                $email = User::where('id', '!=', Auth::id())->where('mobile', $request->mobile_number)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Mobile already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }


            $user = User::where('id', Auth::id())->update($insert);

            if ($user) {
                $userdata = User::where('id', Auth::id())->first();
                $userdata->profile = !empty($userdata->profile) ? url('uploads/profile') . '/' . $userdata->profile : '';
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data']['user'] = $userdata;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }

    public function getBankList()
    {
        $banks = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY')
        ])->get('https://api.flutterwave.com/v3/banks/NG');
        $data = $banks->json();
        return response()->json([
            'status' => 1,
            'message' => 'Bank List',
            'data' => $data['data']
        ]);
    }

    public function validate_bank_account(Request $request)
    {
        try {
            $request->validate([
                'account_number' => 'required|string',
                'bank_code' => 'required|string',
            ]);

            $bank = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET')
            ])->get('https://api.paystack.co/bank/resolve?account_number=' . $request->account_number . '&bank_code=' . $request->bank_code);

            $data = $bank->json();


            if ($data['status'] == true) {
                $result = [
                    "account_number" => $data['data']['account_number'],
                    "account_name" => $data['data']['account_name'],
                ];

                return $this->sendResponse('', $result);
            } else {
                return $this->sendError('Invalid Account Number', null, 500);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), null, 500);
        }
    }

    public function add_service_bank_detail(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_number' => 'required',
            'bank_code' => 'required',
            'account_holder_name' => 'required',

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $bank_detail = DB::table('service_bank_details')->where('user_id', Auth::id())->first();

        if (!empty($bank_detail)) {
            $bank_detail = DB::table('service_bank_details')->where('user_id', Auth::id())->update([
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->bank_code,
                'account_holder_name' => $request->account_holder_name,
            ]);
            if ($bank_detail) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again an error occured';
                $arr['data'] = NULL;
                return response()->json($arr, 500);
            }
        }

        $insert['bank_name'] = $request->bank_name;
        $insert['account_number'] = $request->account_number;
        $insert['ifsc_code'] = $request->bank_code;
        $insert['account_holder_name'] = $request->account_holder_name;
        $insert['user_id'] = Auth::id();

        $add_bank = DB::table('service_bank_details')->insert($insert);

        if ($add_bank) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'Try Again';
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }


    public function update_bank_details(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_number' => 'required',
            'branch_address' => 'required',
            'account_holder_name' => 'required',

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        // try
        // {
        $insert['bank_name'] = $request->bank_name;
        $insert['account_number'] = $request->account_number;
        $insert['branch_address'] = $request->branch_address;
        $insert['ifsc_code'] = $request->ifsc_code;
        $insert['account_holder_name'] = $request->account_holder_name;
        $insert['user_id'] = Auth::id();

        $add_bank = DB::table('service_bank_details')->where('user_id', Auth::id())->update($insert);

        if ($add_bank) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'Try Again';
            $arr['data'] = NULL;
        }
        // }
        // catch(\Exception $e)
        // {
        //     $arr['status']=0;
        //     $arr['message']="something went wrong";
        //     $arr['data']= NULL;
        // }

        return response()->json($arr, 200);
    }


    public function get_bank_details(Request $request)
    {


        // try
        // {

        $get_bank_details = DB::table('service_bank_details')->where('user_id', Auth::id())->first();

        if ($get_bank_details) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_bank_details;
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'Try Again';
            $arr['data'] = NULL;
        }
        // }
        // catch(\Exception $e)
        // {
        //     $arr['status']=0;
        //     $arr['message']="something went wrong";
        //     $arr['data']= NULL;
        // }

        return response()->json($arr, 200);
    }

    public function service_change_password(Request $request)
    {
        $validate = Validator::make($request->all(), [

            'old_password' => 'required',
            'new_password' => 'required',

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }


        // try
        // {
        // print_r(Auth::id());die;
        $get_user_id = DB::table('users')->where('id', Auth::id())->first();

        if (!empty($get_user_id)) {
            if (!Hash::check($request->old_password, $get_user_id->password)) {
                $arr['status'] = 0;
                $arr['message'] = 'Old Password is not matched';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }

            $data['password'] = Hash::make($request->new_password);
            $update_new_pwd = DB::table('users')->where('id', Auth::id())->update($data);
            if ($update_new_pwd) {

                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = null;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
            }
        }



        // }
        // catch(\Exception $e)
        // {
        //     $arr['status']=0;
        //     $arr['message']="something went wrong";
        //     $arr['data']= NULL;
        // }

        return response()->json($arr, 200);
    }

    public function gps_on(Request $request)
    {
        $validate = Validator::make($request->all(), [

            'location' => 'required',
            'loc_lat' => 'required',
            'loc_long' => 'required',
            'status' => 'required',
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
        // 1 offline
        // 2 onservice

        // try
        // {
        // print_r(Auth::id());die;

        $chk_exit_user = DB::table('service_gps_location')->where('user_id', Auth::id())->first();

        if (!empty($chk_exit_user)) {
            $data['location'] = $request->location;
            $data['loc_lat'] = $request->loc_lat;
            $data['loc_long'] = $request->loc_long;
            $data['status'] = $request->status;


            $update_loc = DB::table('service_gps_location')->where('user_id', Auth::id())->update($data);
            if ($update_loc) {
                DB::table("users")->where('id', Auth::id())->update(['gps_location_status' => $request->status, 'location_lat' => $request->loc_lat, 'location_long' => $request->loc_long]);
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        } else {
            $data['location'] = $request->location;
            $data['loc_lat'] = $request->loc_lat;
            $data['loc_long'] = $request->loc_long;
            $data['status'] = $request->status;
            $data['user_id'] = Auth::id();



            $update_loc = DB::table('service_gps_location')->insert($data);

            if ($update_loc) {
                DB::table("users")->where('id', Auth::id())->update(['gps_location_status' => $request->status, 'location_lat' => $request->loc_lat, 'location_long' => $request->loc_long]);
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = null;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        }
    }

    public function user_setting(Request $request)
    {

        $validate = Validator::make($request->all(), [

            'type' => 'required',         // 1=>what_app, 2=>sms, 3=>notification
            'status' => 'required',      // 1=>on, 2=>off
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();

        if ($request->type == 1) {
            $data['what_app'] = $request->status;
            $update_status = DB::table('users')->where('id', $user_id)->update($data);
            if ($update_status) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'something went worng..';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        }

        if ($request->type == 2) {
            $data['sms'] = $request->status;
            $update_status = DB::table('users')->where('id', $user_id)->update($data);
            if ($update_status) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'something went worng..';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        }

        if ($request->type == 3) {
            $data['notification'] = $request->status;
            $update_status = DB::table('users')->where('id', $user_id)->update($data);
            if ($update_status) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'something went worng..';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        }
    }


    public function cancel_booking(Request $request)
    {

        $validate = Validator::make($request->all(), [

            'booking_id' => 'required',
            'cacel_resgion' => 'required',
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();

        $data['status'] = 3;
        $data['cancel_reason'] = $request->cacel_resgion;
        $update_status = DB::table('servicebook_user')->where('id', $request->booking_id)->update($data);
        if ($update_status) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'something went worng..';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function service_notification(Request $request)
    {

        $user_id = Auth::id();


        $get_notification = DB::table('notifications')->where('user_id', $user_id)->orderBy('id', 'desc')->get()->toArray();

        if ($get_notification) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_notification;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'notification not found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }

    public function delete_service_provider_notification(Request $request)
    {

        $user_id = Auth::id();


        $get_notification = DB::table('notifications')->where('user_id', $user_id)->delete();
        if ($get_notification) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'notification not found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }

    public function user_contact_details(Request $request)
    {
        $validate = Validator::make($request->all(), [

            'user_id' => 'required',

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();


        $get_user_detsils = DB::table('users')->where('id', $request->user_id)->first();
        $get_user_detsils->profile = $get_user_detsils->profile ? url('uploads/profile') . '/' . $get_user_detsils->profile : '';
        $get_user_detsils->id_prof = $get_user_detsils->id_prof ? url('uploads/id_prof') . '/' . $get_user_detsils->id_prof : '';
        if ($get_user_detsils) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_user_detsils;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'something went worng..';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function service_home(Request $request)
    {

        $user_id = Auth::id();

        // update provider lat long
        $provider = User::find($user_id);
        $provider->location_lat  = $request->latitude;
        $provider->location_long  = $request->longitude;
        $provider->save();


        $get_user_detsils = DB::table('my_wallet')->where('user_id', $user_id)->first();
        if (!empty($get_user_detsils)) {
            $mywallet['amount'] = $get_user_detsils->amount;
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $mywallet;
            return response()->json($arr, 200);
        } else {
            $mywallet['amount'] = 0;
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $mywallet;
            return response()->json($arr, 200);
        }
    }

    public function payment_history(Request $request)
    {

        $user_id = Auth::id();

        //$get_user_detsils = DB::table('service_payment_history')->where('user_id',$user_id)->get()->toArray();
        $get_user_detsils = DB::table('service_payment_history')->get()->toArray();
        if (!empty($get_user_detsils)) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_user_detsils;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }


    public function service_booking_accept(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();

        $data['status'] = 3;
        $get_user_detsils = DB::table('servicebook_user')->where('booking_id', $request->booking_id)->update($data);
        if (!empty($get_user_detsils)) {
            /*************  send mail  ******************************/
            $get_book_data =  DB::table('servicebook_user')->select('id', 'user_id', 'booking_id')->where('booking_id', $request->booking_id)->first();
            // if ($get_book_data) {
            //     // get user record
            //     $get_user_data =  DB::table('users')->select('id', 'name', 'email')->where('id', $get_book_data->user_id)->first();
            //     if ($get_user_data) {
            //         $data['name'] = $get_user_data->name;
            //         $data['msg'] = "Service Request Accepted : your  service " . $bookingId . " is  Accepted ";
            //         $data['subject'] = "Service Accepted";

            //         \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
            //     }
            // }
            /***********  end  **********************************************/

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'faills';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }

    public function service_booking_complete(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'booking_id' => 'required',
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();

        $data['status'] = 3;
        $get_user_detsils = DB::table('servicebook_user')->where('booking_id', $request->booking_id)->update($data);
        if (!empty($get_user_detsils)) {
            /*************  send mail  ******************************/
            $get_book_data =  DB::table('servicebook_user')->select('id', 'user_id', 'booking_id')->where('booking_id', $request->booking_id)->first();
            // if ($get_book_data) {
            //     // get user record
            //     $get_user_data =  DB::table('users')->select('id', 'name', 'email')->where('id', $get_book_data->user_id)->first();
            //     if ($get_user_data) {
            //         $data['name'] = $get_user_data->name;
            //         $data['msg'] = "Service Completed : your  service " . $bookingId . " is  Completed ";
            //         $data['subject'] = "Service Completed";

            //         \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
            //     }
            // }
            /***********  end  **********************************************/
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }


    public function service_subscription_plans()
    {

        try {
            $get_subscriprion_plan = DB::table('service_subscription_plans')->where('status', 1)->get()->toArray();
            if (!empty($get_subscriprion_plan)) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $get_subscriprion_plan;
                return response()->json($arr, 200);
            }

            // 
            $arr['status'] = 0;
            $arr['message'] = 'failed';
            $arr['data'] = null;
            return response()->json($arr, 422);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }

    public function upcomming_booking_accept_reject(Request $request)
    {

        $validate = Validator::make($request->all(), [

            'booking_id' => 'required',
            'status' => 'required',        //  1=>accept, 2=>reject

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();
        if ($request->status == 1) {
            $data['status'] = 2;
        } elseif ($request->status == 2) {
            $data['status'] = 5;
        }



        $update_status = DB::table('servicebook_user')->where('booking_id', $request->booking_id)->update($data);
        if (!empty($update_status)) {
            /*************  send mail  ******************************/

            $get_book_data =  DB::table('servicebook_user')->select('id', 'user_id', 'booking_id')->where('booking_id', $request->booking_id)->first();
            // if ($get_book_data) {
            //     // get user record
            //     $get_user_data =  DB::table('users')->select('id', 'name', 'email')->where('id', $get_book_data->user_id)->first();
            //     if ($get_user_data) {
            //         if ($request->status == 1) {
            //             $data['name'] = $get_user_data->name;
            //             $data['msg'] = "Service Request Accepted : your service " . $request->booking_id . " is  Accepted ";
            //             $request->data['subject'] = "Service Accepted";
            //         } else {
            //             $data['name'] = $get_user_data->name;
            //             $data['msg'] = "Service Request Rejected : your service " . $request->booking_id . " is  Rejected ";
            //             $data['subject'] = "Service Rejected";
            //         }

            //         // \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
            //     }
            // }

            /***********  end  **********************************************/
            $arr['status'] = 1;
            $arr['message'] = $request->status == 1 ? "Booking Accepted" : "Booking Rejected";
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }


    public function service_paymet_request(Request $request)
    {

        $validate = Validator::make($request->all(), [


            'amount' => 'required',

        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        $user_id = Auth::id();
        $data['driver_id'] = $user_id;
        $data['amount'] = $request->amount;
        $data['type'] = 3;

        $chk_blance = DB::table('users')->where('id', $user_id)->first();

        $update_status = DB::table('request_withdrawn_amounts')->insert($data);

        $get_my_amt = DB::table('my_wallet')->where('user_id', $user_id)->first();
        $new_amt = $get_my_amt->amount - $request->amount;
        $newamt['amount'] = $new_amt;

        $update_new_amt = DB::table('my_wallet')->where('user_id', $user_id)->update($newamt);

        $data1['user_id'] = $user_id;
        $data1['user_name'] = $chk_blance->name;
        $data1['amount'] = $request->amount;
        $data1['message'] = "Rs. $request->amount has been debited from your wallet.";

        $dabit_amt = DB::table('service_payment_widral_history')->insert($data1);

        if (!empty($update_status)) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'Success';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }

    public function service_paymet_widhral_list(Request $request)
    {

        $user_id = Auth::id();


        $get_user_detsils = DB::table('service_payment_widral_history')->where('user_id', $user_id)->get()->toArray();
        if (!empty($get_user_detsils)) {

            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $get_user_detsils;
            return response()->json($arr, 200);
        } else {

            $arr['status'] = 0;
            $arr['message'] = 'record not found';
            $arr['data'] = null;
            return response()->json($arr, 200);
        }
    }

    function get_subscription_plan()
    {
        $s_p_id = Auth::id();

        $final = ServicePlanPurchase::where('service_provider_id', $s_p_id)->where('status', 1)->with('service_subscription_plans')->first();

        if ($final) {
            $arr['status'] = 1;
            $arr['message'] = "Success";
            $arr['data'] = $final;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = "No record found";
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }


    function buy_subscription_plan(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'subscription_plan_id' => 'required',
                "transaction_code" => 'required'
            ]
        );

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }

        $s_p_id = Auth::id();
        //get subcription plan list
        $sub_d = DB::table("service_subscription_plans")->where("id", $request->subscription_plan_id)->first();
        if (!$sub_d) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }


        $data['service_provider_id'] =  $s_p_id;
        $data['subscription_plan_id'] =  $sub_d->id;
        $data['amount'] =  $sub_d->amount;
        $data['purchase_date'] =  Date('Y-m-d');
        $data['transaction_id'] =  $request->transaction_code;
        $data['validity'] =  $sub_d->days;
        $data['status'] =  1;
        $data['plan_name'] =  $sub_d->plan_type;

        DB::table("service_plan_purchase")->where('id', $s_p_id)->update(['status' => 0]);

        $new_id = DB::table("service_plan_purchase")->insertGetId($data);

        $final = DB::table("service_plan_purchase")->where('id', $new_id)->first();

        if ($final) {
            $arr['status'] = 1;
            $arr['message'] = 'success';
            $arr['data'] = $final;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'failed';
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }
}