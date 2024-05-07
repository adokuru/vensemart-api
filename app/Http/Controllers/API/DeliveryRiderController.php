<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\NotifyViaMqtt;
use App\Models\DeliveryRequestStatus;
use App\Models\EshopPurchaseDetail;
use App\Models\MyWallet;
use App\Models\Orders;
use App\Models\RideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\VehicleDetails;
use App\Models\WalletHistorys;
use App\Notifications\RideNotification;
use Carbon\Carbon;
use App\Traits\SendNotification;
use App\Traits\SendMessage;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
// use OneSignal;
// use Ladumor\OneSignal\OneSignal;

class DeliveryRiderController extends Controller
{

    use SendNotification;
    use SendMessage;

    function test(Request $request)
    {
        $data = array('title' => 'test', 'message' => 'this is', 'user_id' => 71);
        $this->send_to_user($data);
    }

    // @send_test_notification
    public function send_test_notification(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);

        $notification_data = [
            'id'   => $user->id,
            'type' => "New ride request",
            'subject' => 'New Ride Requested',
            'message' => 'New Ride Requested',
            'page' => 'ride_request',
        ];

        $fields['include_player_ids'] = [$user->device_token];
        $title = 'New Ride Requested';
        $message = 'hey!! this is test push.!';

        $params = [];
        $params['include_player_ids'] = [$user->device_token];
        $params['headings'] = ['en' => $title];
        $params['contents'] = ['en' => $message];
        $params['data'] = $notification_data;


        // $test =  \OneSignal::sendPush($fields, $message);


        $test = \OneSignal::sendNotificationCustom($params);
        // $test = \OneSignal::sendNotificationToUser(
        //     $notification_data['subject'],
        //     $notification_data['message'],
        //     $user->device_token,
        //     $url = null,
        //     $data = null,
        // );
        dd('Notification sent successfully!', $test, $notification_data, $user);
        // $test = $user->notify(new RideNotification($notification_data['type'], $notification_data));

        // dd('Notification sent successfully!', $test, $notification_data, $user);\



        // $fields['include_player_ids'] = [$user->device_token];
        // $message = 'hey!! this is test push.!';

        // OneSignal::sendPush($fields, $message);
        // $this->send_to_user($data);
    }


    function onBoardRider(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'vehicle_type' => 'required|in:car,bike,truck',
            'vehicle_number' => 'required',
            'picture' => 'required',
        ]);

        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 403);
            }

            $user = Auth::user();
            $vehicle_details = $request->all();
            if (!empty($vehicle_details['picture'])) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('picture')->getClientOriginalName();
                $store = $request->file('picture')->move(storage_path('uploads/all_image'), $file_name);
                // dd($file_name, $store);
                if ($store) {
                    $vehicle_details['dl_picture'] = $file_name;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Vehicle image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }


            VehicleDetails::create([
                'user_id' => $user->id,
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'dl_picture' => $vehicle_details['dl_picture'],
                'status' => 1,
                'isVerify' => 0,
            ]);

            return $this->sendResponse('Vehicle details added successfully');
        } catch (Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;

            return response()->json($arr, 500);
        }
    }


    public function delivery_rider_register(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'type' => 'required',
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = "Validation Failed";
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $users = User::where(function ($query) use ($request) {
                $query->where('email', $request->email);
                $query->orwhere('mobile', $request->mobile);
            })
                ->first();

            if ($users) {
                $arr['status'] = 0;
                $arr['message'] = 'E-mail id or Phone number already exist!!';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }

            $data = $request->all();
            unset($data['vehicle_type']);
            unset($data['vehicle_number']);
            unset($data['dl_number']);
            unset($data['dl_picture']);
            unset($data['dl_picture']);
            unset($data['insurance_picture']);
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            DB::beginTransaction();
            try {
                $user = User::create($data);
                $token = $user->createToken('FreshMor')->accessToken;
                User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token]);
                $userArr = User::where('id', $user->id)->get()->first();
                if ($user) {
                    $validator = Validator::make($request->all(), [
                        'vehicle_type' => 'required',
                        'vehicle_number' => 'required',
                        'dl_number' => 'required',
                        'dl_picture' => 'required',
                        'insurance_number' => 'required',
                        'insurance_picture' => 'required',
                        'state' => 'required',
                        'town' => 'required'
                    ]);
                    $vehicle_details = $request->all();
                    unset($vehicle_details['name']);
                    unset($vehicle_details['email']);
                    unset($vehicle_details['mobile']);
                    unset($vehicle_details['password']);
                    unset($vehicle_details['type']);
                    unset($vehicle_details['device_id']);
                    unset($vehicle_details['device_type']);
                    unset($vehicle_details['device_name']);
                    unset($vehicle_details['device_token']);
                    $vehicle_details['user_id'] = $user->id;
                    if (!empty($vehicle_details['dl_picture'])) {
                        $file_name = date('dmy') . rand(1, 4) . $request->file('dl_picture')->getClientOriginalName();
                        $store = $request->file('dl_picture')->move('uploads/all_image', $file_name);
                        if ($store) {
                            $vehicle_details['dl_picture'] = $file_name;
                        } else {
                            $arr['status'] = 0;
                            $arr['message'] = 'DL image not uploaded!!';
                            $arr['data'] = NULL;

                            return response()->json($arr, 200);
                        }
                    }
                    if (!empty($vehicle_details['insurance_picture'])) {
                        $file_name1 = date('dmy') . rand(1, 4) . $request->file('insurance_picture')->getClientOriginalName();
                        $store = $request->file('insurance_picture')->move('uploads/all_image', $file_name1);
                        if ($store) {
                            $vehicle_details['insurance_picture'] = $file_name1;
                        } else {
                            $arr['status'] = 0;
                            $arr['message'] = 'Insurance image not uploaded!!';
                            $arr['data'] = NULL;

                            return response()->json($arr, 200);
                        }
                    }
                    // print_r($vehicle_details);die;
                    DB::table('vehicle_details')->insert($vehicle_details);
                    $vehicleArr = DB::table('vehicle_details')->where('user_id', $user->id)->first();
                    DB::commit();
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data']['user_details'] = $userArr;
                    $arr['data']['vehicle_details'] = $vehicleArr;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Try Again';
                    $arr['data'] = NULL;
                }
                return response()->json($arr, 200);
            } catch (\Exception $e) {
                DB::rollback();
                $arr['status'] = 0;
                $arr['message'] = 'something went wrong';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "Something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    //Home Screen API
    public function dhome(Request $request)
    {
        try {
            // DB::table('users')->where('id', Auth::id())->update(['location_lat' => $request->location_lat, 'location_long' => $request->location_long]);
            $total_order = DB::table('orders')->where('driver_id', Auth::id())->count();
            $total_earning = DB::table('my_wallet')->where('user_id', Auth::id())->sum('amount');
            $availibility = DB::table('users')->where('id', Auth::id())->where('status', '1')->first();
            $is_online = DB::table('users')->where('id', Auth::id())->where('is_online', '1')->first();
            $pending_order = DB::table('orders')->where('driver_id', Auth::id())->where('status', '2')->orWhere('status', '1')->count();
            $completed_order = DB::table('orders')->where('driver_id', Auth::id())->where('status', '4')->count();
            $today_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->whereDate('o.order_date', date('Y-m-d'))->get()->toArray();
            $data['total_order'] = $total_order != 0 ? $total_order : 0;
            $data['total_earning'] = $total_earning != 0 ? number_format((float)$total_earning, 2, '.', '') : 0.00;
            $data['today_order'] = $today_order != [] ? $today_order : [];
            $data['availibility'] = $availibility != '' ? "yes" : "no";
            $data['is_online'] = $is_online != '' ? "yes" : "no";
            $data['pending_order'] = $pending_order != 0 ? $pending_order : 0;
            $data['completed_order'] = $completed_order != 0 ? $completed_order : 0;
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $data;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }
    //All Order API
    public function all_orders()
    {

        try {
            $all_order =
                // DB::table('orders as o')
                //     ->select('o.*', 's.store_name', 's.address as store_address', "s.lati as store_latitude", "s.longi as store_longitude", 'ua.location as delivery_address', 'ua.location_lat as delivery_latitude', 'ua.location_long as delivery_longitude')
                //     ->leftjoin('stores as s', 's.id', 'o.shop_id')
                //     ->leftjoin('users as ua', 'ua.id', 'o.user_id')
                //     ->where('o.driver_id', Auth::id())
                DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")

                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                ->where('o.driver_id', Auth::id())

                ->whereNotIn('o.status', [1])->get()->toArray();
            // return $all_order;                
            if ($all_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $all_order;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }

    //Pending Order API
    public function pending_order()
    {
        try {


            $pending_order = DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    'rr.status as ride_status',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN o.driver_id = " . Auth::id() . " THEN 1 ELSE 0 END AS show_for_current_driver"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")
                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                // ->where('o.driver_id', Auth::id())
                ->where(function ($query) {
                    $query->where('o.status', '1')
                        ->orWhere('o.status', '3')

                        ->orWhere('o.status', '2');
                })
                ->orderBy('show_for_current_driver', 'DESC') // Prioritize orders for the current driver
                // ->orWhereNotIn('rr.status', ['cancelled', 'completed'])
                // Use whereIn to check for multiple statuses
                ->get();






            //     $pending_order = DB::table('orders as o')
            //         ->select(
            //             'o.*',
            //             's.store_name',
            //             's.address as store_address',
            //             "s.lati as store_latitude",
            //             "s.longi as store_longitude",
            //             'ua.location as delivery_address',
            //             'ua.location_lat as delivery_latitude',
            //             'ua.location_long as delivery_longitude',
            //             'ua.mobile as delivery_mobile',
            //         )
            //         ->leftjoin('stores as s', 's.id', 'o.shop_id')
            //         ->leftjoin('users as ua', 'ua.id', 'o.user_id')
            //         ->where('o.driver_id', Auth::id())->where('o.status', '2')->get();
            // }



            if ($pending_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $pending_order;
            }
            // return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }
    //Cancel order API
    public function cancel_order(Request $request)
    {
        try {
            // $cancel_order = DB::table('orders as o')
            //     ->select('o.*')
            //     ->where('o.driver_id', Auth::id())->where('o.status', '7')->get()->toArray();

            //pos_registration
            //stores
            //product
            //category
            //subcategory
            //bank

            $cancel_order =
                //  DB::table('orders as o')
                //     ->select('o.*', 's.store_name', 's.address as store_address', "s.lati as store_latitude", "s.longi as store_longitude", 'ua.location as delivery_address', 'ua.location_lat as delivery_latitude', 'ua.location_long as delivery_longitude')
                //     ->leftjoin('stores as s', 's.id', 'o.shop_id')
                //     ->leftjoin('users as ua', 'ua.id', 'o.user_id')
                //     ->where('o.driver_id', Auth::id())
                DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")
                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                ->where('o.driver_id', Auth::id())

                ->where('o.status', '7')->get()->toArray();

            if ($cancel_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $cancel_order;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }
    //Complete order API
    public function complete_order(Request $request)
    {
        try {
            // $complete_order = DB::table('orders as o')
            //     ->select('o.*')
            //     ->leftjoin('stores as s', 's.id', 'o.shop_id')
            //     ->leftjoin('users as u', 'u.id', 'o.user_id')
            //     ->where('o.driver_id', Auth::id())->where('o.status', '4')->get()->toArray();


            $complete_order =
                // DB::table('orders as o')
                //     ->select(
                //         'o.*',
                //         's.store_name',
                //         's.address as store_address',
                //         "s.lati as store_latitude",
                //         "s.longi as store_longitude",
                //         'ua.location as delivery_address',
                //         'ua.location_lat as delivery_latitude',
                //         'ua.location_long as delivery_longitude'
                //     )
                //     ->leftjoin('stores as s', 's.id', 'o.shop_id')
                //     ->leftjoin('users as ua', 'ua.id', 'o.user_id')
                //     ->where('o.driver_id', Auth::id())
                DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")

                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                ->where('o.driver_id', Auth::id())
                ->where('o.status', '4')->get()->toArray();


            if ($complete_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $complete_order;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }
    //Accept order API
    public function accept_order(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $validator->errors()->first();
                return response()->json($arr, 422);
            }

            $orderid = $request->order_id;
            $driverId = Auth::id();

            // $order = DB::table('orders')->where('id', $orderid)->where('status', '2')->orWhere('status', '1')->first();
            $order = Orders::where('id', $orderid)
                ->whereIn('status', ['1', '2'])
                ->first();
            // $order = DB::table('orders')->where('id', $orderid)->where('status', '2')->where('driver_id', $driverId)->first();

            // dd($order, $orderid, $driverId);


            if ($order) {
                // if ride_request_id is not null, then update the status of the ride_request to 2
                Orders::where('id', $orderid)->update(['status' => "3", 'driver_id' => $driverId]);

                RideRequest::where('order_id', $orderid)->update(['status' => "accepted", 'driver_id' => $driverId]);

                $this->sendNotification($order->user_id, 'Order Accepted', 'Your order has been accepted by the driver ');

                $arr['status'] = 1;
                $arr['message'] = 'Order Accepted Successfully!!';
                $arr['data'] = [
                    'booking_id' => $order->id,
                    'status' => $order->status,
                ];
                return response()->json($arr, 200);
            } else {

                $arr['status'] = 0;
                $arr['message'] = 'Order already accepted or not found';
                return response()->json($arr, 200);
            }


            // $this->sendNotification($order->user_id, 'Order Accepted', 'Your order has been accepted by the driver ');

            // if ($order->ride_request_id != null) {
            // DB::table('ride_requests')->where('id', $order->ride_request_id)->update(['status' => "accepted", 'driver_id' => $driverId]);
            // }

            // $order_request = DB::table('orders as o')
            //     ->select(
            //         'o.*',
            //         'r.*',
            //         'u.name as user_name',
            //         'u.mobile as user_phone',
            //         'u.email as user_email',
            //         'u.id as user_id',
            //         'd.id as driver_id',
            //         'd.name as driver_name',
            //         'd.mobile as driver_phone',
            //         'd.email as driver_email',

            //     )
            //     ->join('ride_requests as r', 'r.id', 'o.ride_request_id')
            //     ->join('users as u', 'u.id', 'o.user_id')
            //     ->join('users as d', 'd.id', 'o.driver_id')

            //     ->orderBy('o.created_at', 'desc') // Order by creation date in descending order
            //     ->first();

            // $history_data = [
            //     'history_type'      => $order_request->status,
            //     'ride_request_id'   => $order_request->ride_request_id,
            //     'ride_request'      => $order_request,
            // ];

            // // $this->get_order_request();
            // dd($history_data);

            // $this->saveRideHistory($history_data);

        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            // $arr['data']    = NULL;
            return response()->json($arr, 200);
        }
    }



    //complete without otp
    public function complete_order_noOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $validator->errors()->first();
                return response()->json($arr, 422);
            }

            $orderid = $request->order_id;
            $driverId = Auth::id();

            // $order = DB::table('orders')->where('id', $orderid)->where('status', '3')->where('driver_id', $driverId)->first();
            $order = DB::table('orders')->where('id', $orderid)->where('driver_id', $driverId)->first();

            if ($order == null) {
                $arr['status'] = 0;
                $arr['message'] = 'Order not found or already accepted';
                return response()->json($arr, 200);
            }


            Orders::where('id', $orderid)->update(['status' => "4"]);

            RideRequest::where('id', $order->ride_request_id)->update(['status' => "completed"]);

            $arr['status'] = 1;
            $arr['message'] = 'Order Completed Successfully!!';
            // $arr['data'] = true;

            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }


    public function complete_order_sms(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $validator->errors()->first();
                return response()->json($arr, 422);
            }

            $orderid = $request->order_id;
            $userphone = $request->phone;


            // $otp = rand(1000, 9999);
            // $users->otp = $otp;
            // $users->save();


            //send otp to user
            //update order with otp
            //if otp entered is correct, change status of 

            $driverId = Auth::id();

            $order = DB::table('orders')->where('id', $orderid)->where('driver_id', $driverId)->first();
            $ride_request = DB::table('ride_requests')->where('order_id', $orderid)->first();

            if ($order == null) {
                $arr['status'] = 0;
                $arr['message'] = 'Order not found or already accepted';
                return response()->json($arr, 200);
            }

            if ($ride_request->is_ride_for_other == 1) {
                // $jsonData = '{"name":"James","phone_number":"7030625895"}';
                // var_dump($ride_request->other_rider_data);
                // $other_user = json_decode($ride_request->other_rider_data, true);

                // var_dump($other_user);
                $other_user = $ride_request->other_rider_data['phone_number'];

                $phoneNumber = $other_user;
                // dd($phoneNumber);
                // $other_user = json_decode($ride_request->other_rider_data);
                // dd($other_user->phone_number);
                $this->sendSMSMessage(
                    "+234" . substr($phoneNumber, -10),
                    "order-" . $order->id . " has been picked up successfully!! use this pin to complete your order: " . $order->otp
                );
            } else {
                $this->sendSMSMessage(
                    "+234" . substr($userphone, -10),
                    "order-" . $orderid . " has been picked up successfully!! use this pin to complete your order: " . $order->otp
                );
            }

            // $this->sendSMSMessage(
            //     "+234" . substr($userphone, -10),
            //     "order-" . $orderid . " has been picked up successfully!! use this pin to complete your order: " . $otp
            // );

            // Orders::where('id', $orderid)->update(['otp' => "$otp"]);

            $arr['status'] = 1;
            $arr['message'] = 'Order Otp Sent Successfully!!';
            $arr['data'] = true;

            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }




    public function validate_order_details(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'otp' => 'required',
            ]);

            if ($validator->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $validator->errors()->first();
                return response()->json($arr, 422);
            }

            $orderid = $request->order_id;
            //  $userphone = $request->phone;




            //  $otp = rand(1000, 9999);
            // $users->otp = $otp;
            // $users->save();


            //send otp to user
            //update order with otp
            //if otp entered is correct, change status of 

            $driverId = Auth::id();

            $order = DB::table('orders')->where('id', $orderid)->where('driver_id', $driverId)->first();
            // $order = DB::table('orders')->where('id', $orderid)->where('status', '3')->where('driver_id', $driverId)->first();

            $user_id = $order->user_id;

            if ($order == null) {
                $arr['status'] = 0;
                $arr['message'] = 'Order not found or already accepted';
                return response()->json($arr, 200);
            }

            $this->addUserWallet($order->driver_id, 1500);


            //  $this->sendSMSMessage(
            //     "+234" . substr($userphone, -10),
            //     "order-" . $orderid . " has been picked up successfully!! use this pin to complete your order: " . $otp
            // );

            if ($order->otp != $request->otp) {
                $arr['status'] = 0;
                $arr['message'] = 'Pin does not match';
                return response()->json($arr, 200);
            }

            $walletamount = DB::table('my_wallet')->where('user_id', $order->driver_id)->first();

            $useramount = DB::table('my_wallet')->where('user_id', $user_id)->first();

            Log::info("orderid : $order->driver_id");

            $driveramount = (int)$walletamount->amount;

            $c_driveramount = (int)$walletamount->c_amount;


            $net_earned_on_ride = (80 / 100) * $order->delivery_charge + $order->net_amount;
            $newamount = $driveramount + $net_earned_on_ride;

            // for c_driveramount its based on if the user paid with cash 20 percent of the  charge is added to the driver wallet
            $c_net_earned_on_ride = (20 / 100) * $order->total_amount;
            $c_newamount = $c_driveramount + $c_net_earned_on_ride;


            // $total_amount = $order->delivery_charge + $order->net_amount;

            // subtract from user wallet check if user has enough money to pay for delivery and if order payment type is wallet
            // if not enough money, return error message
            // if enough money, subtract from user wallet and add to driver wallet


            $useramount = (int)$useramount->amount;

            if ($order->payment_type == 1) {
                // if ($useramount < $total_amount) {
                //     $arr['status'] = 0;
                //     $arr['message'] = 'Customer has Insufficient funds in wallet to pay for delivery charge';
                //     return response()->json($arr, 200);
                // }

                // $newuseramount = $useramount - $total_amount;
                $newuseramount = $useramount - $order->total_amount;

                Log::info("newuseramount : $newuseramount");

                DB::table('my_wallet')->where('user_id', $order->driver_id)->update(['amount' => $newamount]);

                $wallet_transaction = new WalletHistorys();
                $wallet_transaction->user_id = $order->driver_id;
                $wallet_transaction->amount = $net_earned_on_ride;
                $wallet_transaction->status = 2;
                $wallet_transaction->message = "Delivery Charge";
                $wallet_transaction->save();


                DB::table('my_wallet')->where('user_id', $user_id)->update(['amount' => $newuseramount]);

                $wallet_transaction = new WalletHistorys();
                $wallet_transaction->user_id = $user_id;
                $wallet_transaction->amount = $net_earned_on_ride;
                $wallet_transaction->status = 1;
                $wallet_transaction->message = "Delivery Charge";
                $wallet_transaction->save();
            } else if ($order->payment_type == 2) {
                $newuseramount = $useramount - $order->total_amount;


                DB::table('my_wallet')->where('user_id', $order->driver_id)->update(['c_amount' => $c_newamount]);

                $wallet_transaction = new WalletHistorys();
                $wallet_transaction->user_id = $order->driver_id;
                $wallet_transaction->amount = $c_net_earned_on_ride;
                $wallet_transaction->status = 2;
                $wallet_transaction->message = "Delivery Charge";
                $wallet_transaction->save();
            }


            // Log::info("newuseramount : $newuseramount");

            // DB::table('my_wallet')->where('user_id', $order->driver_id)->update(['amount' => $newamount]);

            // DB::table('my_wallet')->where('user_id', $user_id)->update(['amount' => $newuseramount]);



            Orders::where('id', $orderid)->update(['status' => "4"]);

            RideRequest::where('id', $order->ride_request_id)->update(['status' => "completed",]);


            Log::info("orderid : $order->driver_id");


            //  $this->addUserWallet($order->driver_id, $order->delivery_charge);


            $arr['status'] = 1;
            $arr['message'] = 'Order Completed Successfully!!';
            $arr['data'] = true;

            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }



    public function addUserWallet($userId, $amount)
    {
        $walletamount = DB::table('my_wallet')->where('user_id', $userId)->first();
        $driveramount = (int)$walletamount->amount;
        $net_earned_on_ride = (85 / 100) * $amount;
        $newamount = $driveramount + $net_earned_on_ride;

        Log::info("newamounnt : $newamount");


        DB::table('my_wallet')->where('user_id', $userId)->update(['amount' => $newamount]);
    }





    public function reject_order(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $validator->errors()->first();
                return response()->json($arr, 422);
            }

            $orderid = $request->order_id;
            $driverId = Auth::id();

            // $order = DB::table('orders')->where('id', $orderid)->where('driver_id', $driverId)->where('status', '2')->orWhere('status', '1')->first();
            $order = Orders::where('id', $orderid)
                ->whereIn('status', ['1', '2'])
                ->first();

            // dd($order, $orderid, $driverId);


            if ($order) {
                DeliveryRequestStatus::where('order_id', $orderid)->where('driver_id', $driverId)->update(['delivery_status' => "2"]);

                Orders::where('id', $orderid)->update(['status' => "7", 'driver_id' => null]);

                RideRequest::where('order_id', $orderid)->update(['status' => "cancelled", 'driver_id' => null]);

                // $this->contactRiderAndVendor($order->order_id, $order->user_id);

                $this->sendNotification($order->user_id, 'Order Rejected', 'Your order has been rejected by the driver ');

                $arr['status'] = 1;
                $arr['message'] = 'Order Rejected Successfully!!';
                // $arr['data'] = true;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Order not found or already rejected';
                return response()->json($arr, 200);
            }
            // if ($order->driver_id != null) {
            //     $arr['status'] = 0;
            //     $arr['message'] = 'Order already accepted by another driver';
            //     return response()->json($arr, 200);
            // }


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            // $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }


    public function assigned_order_list(Request $request)
    {
        try {
            $accept_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->where('o.status', "1")->get()->toArray();
            if ($accept_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $accept_order;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }

    //Earning Management
    public function earning_management()
    {
        try {
            $total_earning = DB::table('my_wallet')->sum('amount');
            $today_earning = DB::table('my_wallet')->whereDate('date', date('Y-m-d'))->sum('amount');
            $yesterday_earning = DB::table('my_wallet')->whereDate('date', date('Y-m-d', strtotime("-1 days")))->sum('amount');
            $data['total_earning'] = number_format((float)$total_earning, 2, '.', '');
            $data['today_earning'] = number_format((float)$today_earning, 2, '.', '');
            $data['yesterday_earning'] = number_format((float)$yesterday_earning, 2, '.', '');
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $data;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }
    //Vehicle Registration API
    public function vehicle_registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'vehicle_type' => 'required',
            'vehicle_number' => 'required',
            'dl_number' => 'required',
            'dl_picture' => 'required',
            'insurance_number' => 'required',
            'insurance_picture' => 'required',
        ]);
        try {
            if ($validator->fails()) {
                $arr['status']  = 0;
                $arr['message'] = "Validation Failed";
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }
            $vehicle_details = $request->all();
            if (!empty($vehicle_details['dl_picture'])) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('dl_picture')->getClientOriginalName();
                $store = $request->file('dl_picture')->move('uploads/all_image', $file_name);
                if ($store) {
                    $vehicle_details['dl_picture'] = $file_name;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'DL image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            if (!empty($vehicle_details['insurance_picture'])) {
                $file_name1 = date('dmy') . rand(1, 4) . $request->file('insurance_picture')->getClientOriginalName();
                $store = $request->file('insurance_picture')->move('uploads/all_image', $file_name1);
                if ($store) {
                    $vehicle_details['insurance_picture'] = $file_name1;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Aadhar image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            // print_r($vehicle_details);die;
            DB::table('vehicle_details')->insert($vehicle_details);
            $arr['status']  = 1;
            $arr['message'] = "Vehicle registration successfully";
            $arr['data']    = NULL;
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = "something went wrong";
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }




    function send_otp_for_product(Request $request)
    {
        $validate = Validator::make($request->all(), ['order_id' => 'required']);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation Failed!!';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }


        $d = DB::table('orders')->select('id', 'user_id', 'otp')->where('order_id', $request->order_id)->first();

        if ($d) {
            // get email
            //send otp
            if ($d->otp) {
                $otp =  $d->otp;
            } else {
                $otp = rand(1000, 9999);
            }
            $ins_array = array('otp' => $otp);
            DB::table('orders')->where('order_id', $request->order_id)->update($ins_array);
            $arr['status'] = 1;
            $arr['message'] = 'otp send!';
            $arr['data'] = $otp;
            return response()->json($arr, 200);
        } else {
            $arr['status'] = 0;
            $arr['message'] = 'Order not found!';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
    }


    public function get_single_order_details(Request $request)
    {
        $validate = Validator::make($request->all(), ['order_id' => 'required']);
        try {
            if ($validate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = 'Validation Failed!!';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $orders = DB::table('orders as o')
                ->select('o.*', 'users.name', 'users.mobile', 'users.location_lat', 'users.location_long', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->join('users', 'users.id', '=', 'o.user_id')
                ->where('o.order_id', $request->order_id)->first();
            // print_r($orders);die;

            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $product_details =  DB::table('eshop_purchase_detail as od')
                ->select('p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/product_images') . '","/",product_image)  as product_image'))
                ->join('products as p', 'p.id', 'od.product_id')
                ->join('category as c', 'c.id', 'p.category_id')
                ->join('sub_category as sc', 'sc.id', 'p.sub_cat_id')
                ->join('stores as s', 's.id', 'p.shop_id')
                ->join('uom as u', 'u.id', 'p.uom_id')
                ->where('od.order_id', $orders->order_id)
                ->get()->toArray();
            $orders->order_detail = $product_details;
            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order details found successfully";
                $arr['data'] = $orders;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    // is_online
    function on_off_online()
    {
        $userArr = User::where('id', Auth::id())->get()->first();
        // get the lat long of the user

        if ($userArr) {
            $userArr->is_online  = $userArr->is_online == 1 ? 0 : 1;
            $userArr->save();
            // only show name email mobile profile status and is_online
            $userArr = User::select('name', 'email', 'mobile', 'profile', 'status', 'is_online')->where('id', Auth::id())->get()->first();

            $arr['status'] = 1;
            $arr['message'] = "Online Status update successfully!";
            $arr['data'] = $userArr;

            // $arr['data'] = $userArr;
        } else {
            $arr['status'] = 0;
            $arr['message'] = "user not found!";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    function on_off_status(Request $request)
    {
        $validator = Validator::make($request->all(), ['is_online' => 'required']);
        $userArr = User::where('id', Auth::id())->get()->first();
        if ($userArr) {
            $userArr->is_online  = $request->is_online;
            $userArr->save();
            $arr['status'] = 1;
            $arr['message'] = "status update successfully!";
            $arr['data'] = $userArr;
        } else {
            $arr['status'] = 0;
            $arr['message'] = "user not found!";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    function d_get_profile(Request $request)
    {
        $id = Auth::id();
        if ($id) {
            $profile = User::select('*', DB::raw('CONCAT("' . url('storage/uploads/profile') . '","/",profile)  as profile'))->find($id);
            if (!$profile) {
                $arr['status'] = 0;
                $arr['message'] = 'Data not found';
                $arr['data'] = 'Null';
            }

            $vehicleData = DB::table('vehicle_details')->where('user_id', $id)->first();
            if ($vehicleData) {
                $profile->vehicle_type = $vehicleData->vehicle_type;
                $profile->vehicle_number = $vehicleData->vehicle_number;
                $profile->dl_number = $vehicleData->dl_number;
                $profile->aadhar_number = $vehicleData->aadhar_number;
            } else {
                $profile->vehicle_type = '';
                $profile->vehicle_number = '';
                $profile->dl_number = '';
                $profile->aadhar_number = '';
            }
            $arr['status']   = 1;
            $arr['message']   = 'Data not found';
            $arr['data']      = $profile;
        } else {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }


    public function db_update_profile(Request $request)
    {

        $rule = [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            // 'vehicle_type' => 'required', 
            // 'vehicle_number' => 'required', 
            // 'dl_number' => 'required',
            //  'insurance_number' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }
        $id  = Auth::id();
        $user = User::find($id);

        if ($user->type != 2) {
            $arr['status'] = 0;
            $arr['message'] = 'User Type failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        // try
        // {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;


        if ($request->hasFile('profile')) {

            $file_name = date('dmy') . rand(1, 4) . $request->file('profile')->getClientOriginalName();

            $store = $request->file('profile')->move('uploads/profile', $file_name);
            if ($store) {
                $user->profile  = $file_name;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Profile image not uploaded!!';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
        }

        if (!empty($request->email)) {
            $email = User::where('id', '!=', $id)->whereNotIn('type', [1])->where('email', $request->email)->count();
            if ($email >= 1) {
                $arr['status'] = 0;
                $arr['message'] = 'Email already exist.!!';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
        }
        if (!empty($request->mobile)) {
            $mobile = User::where('id', '!=', $id)->whereNotIn('type', [1])->where('mobile', $request->mobile)->count();
            if ($mobile >= 1) {
                $arr['status'] = 0;
                $arr['message'] = 'Mobile already exist.!!';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
        }
        $user->save();
        if ($user && (!empty($request->vehicle_type) || !empty($request->vehicle_number) || !empty($request->dl_number))) {

            DB::table('vehicle_details')->where('user_id', $id)->update([
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'dl_number' => $request->dl_number,
                'insurance_number' => $request->insurance_number
            ]);
        }

        if ($user) {
            $userdata = User::where('id', $id)->first();

            $vehicleData = DB::table('vehicle_details')->where('user_id', $id)->first();
            // $userdata->profile = !empty($userdata->imgae)?url('uploads/profile').'/'.$userdata->image:'';
            $userdata->profile =  !empty($userdata->profile)  ? url('storage/uploads/profile') . '/' . $userdata->profile : '';
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data']['user'] = $userdata;
            $arr['data']['vehicle'] = $vehicleData;
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



    public function withdrawn_request(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5000',
        ]);

        $id  = Auth::id();
        $user = User::find($id);

        try {

            // Bank Details
            $bank = DB::table('bank_details')->where('user_id', $id)->first();
            if (empty($bank)) {
                $arr['status'] = 0;
                $arr['message'] = 'Please add your bank details first';
                $arr['data'] = NULL;
                return response()->json($arr, 403);
            }

            $amount = $request->amount;
            $count = DB::table('my_wallet')->where('user_id', $id)->count();
            if ($count > 0) {
                $walletamount = DB::table('my_wallet')->where('user_id', $id)->first();
                $driveramount = (int)$walletamount->amount;

                if ($amount <= $driveramount) {
                    $status = 1;
                    $data = array('driver_id' => $id, 'amount' => $amount, 'status' => $status);
                    DB::table('request_withdrawn_amounts')->insert($data);
                    $newamount = $driveramount - $amount;
                    DB::table('my_wallet')->where('user_id', $id)->update(['amount' => $newamount]);
                    $arr['status'] = 1;
                    $arr['message'] = 'Request is Sent to the Admin Successfully!!';
                    // $arr['data'] = true;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Sorry!! You did not have insufficent balance';
                    // $arr['data'] = NULL;
                }
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry!! You did not have balance in your wallet';
                // $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            // $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function total_earnings()
    {
        $userId = Auth::id();
        try {
            $walletamount = DB::table('my_wallet')->where('user_id', $userId)->first();
            if (!empty($walletamount)) {
                $data['walletamount'] = $walletamount->amount;
                $data['c_walletamount'] = $walletamount->c_amount;
                $data['transactionhistory'] = DB::table('wallet_historys')->where('user_id', $userId)->get();


                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                MyWallet::create([
                    'user_id' => $userId,
                    'amount' => 0
                ]);
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

    public function aboutus_driver()
    {
        try {
            $data = DB::table('aboutus')->where('id', 2)->first();
            if (!empty($data)) {
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

    public function contactus_driver()
    {
        try {
            $data = DB::table('contact_us')->where('id', 1)->first();
            if (!empty($data)) {
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
    public function allorderslist()
    {
        // print_r('adfasd');die;
        try {
            $data = DB::table('orders')
                ->select(
                    'orders.*',
                    'users.name as user_name',
                    DB::raw('CONCAT("' . url('storage/shop_images') . '","/",stores.store_image)  as store_image')
                )
                ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                ->leftJoin('stores', 'stores.id', '=', 'orders.shop_id')
                ->where('orders.status', 1)
                ->get();

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
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    public function acceptorders_driver(Request $request)
    {
        /*
        1=Accept
        2=Reject
        */
        $type = $request->type;
        $orderid = $request->order_id;
        $driverId = Auth::id();
        // return $driverId;
        try {
            if ($type == "1") {
                DB::table('orders')->where('order_id', $orderid)->update(['status' => "2", 'driver_id' => $driverId]);
                $arr['status'] = 1;
                $arr['message'] = 'Order Accepted Successfully!!';
                $arr['data'] = true;
            }
            if ($type == "2") {
                DB::table('orders')->where('order_id', $orderid)->update(['reject_driver_id' => Auth::id(), 'driver_id' => null]);
                $arr['status'] = 1;
                $arr['message'] = 'Order Cancelled Successfully!!';
                $arr['data'] = true;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }




    public function send_otp_to_delivery(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'username' => 'required',
            ]);
            $otp = rand(1111, 9999);
            $msg = "Dear Applicant, your OTP for vensemart app order delivery is " . $otp . ". Please do not share it with other.";
            if (is_numeric($request->username)) {
                $m_number = "234" . $request->username;
                $this->send_otp($m_number, $msg);
            }
            $data = array(
                'username' => $request['username'],
                'otp' => $otp
            );
            $user_details = User::where('email', $request->username)->orwhere('mobile', $request->username)->first();

            if ($user_details) {
                $upd['otp'] = $otp;
                User::where('id', $user_details->id)->update($upd);
            }



            $sent = true;
            if (strpos($request->username, '@')) {
                $data['email'] = $request->username;
                $data['title1'] = "Dear Applicant";
                $data['msg'] = "your OTP for vensemart app order delivery is " . $otp . ". Please do not share it with other.";
                $data['subject'] = "Otp Received";

                Mail::to($request->username)->send(new \App\Mail\SendOtpMail($data));
            }
            if (!$sent) {
                $arr['status'] = 0;
                $arr['message'] = 'unable to sent otp.';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }


            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $otp;

            return response()->json($arr, 200);
        } catch (Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong.';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
    }


    public function update_order_status(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required|numeric|in:1,2,3,5,6,7',
            'otp' => 'required_if:status,1',
        ]);
        $order_id = $request->order_id;
        $status = $request->status;





        // $order = Orders::where('order_id', $order_id)->where('status', 3)->first();
        $order = Orders::where('id', $order_id)->first();
        $ride_request = RideRequest::where('order_id', $order_id)->first();

        if (!$order) {
            $arr['status'] = 0;
            $arr['message'] = 'Order not found';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        }


        // dd($request->all(), $order);
        switch ($status) {
            case 1:
                if ($order->otp != $request->otp) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Invalid OTP!!';
                    // $arr['data'] = NULL;
                    return response()->json($arr, 422);
                }

                $walletamount = DB::table('my_wallet')->where('user_id', $order->driver_id)->first();

                $useramount = DB::table('my_wallet')->where('user_id', $order->user_id)->first();

                $driveramount = (int)$walletamount->amount;

                $c_driveramount = (int)$walletamount->c_amount;


                $net_earned_on_ride = (80 / 100) * $order->delivery_charge + $order->net_amount;
                $newamount = $driveramount + $net_earned_on_ride;

                // for c_driveramount its based on if the user paid with cash 20 percent of the  charge is added to the driver wallet
                $c_net_earned_on_ride = (20 / 100) * $order->total_amount;
                $c_newamount = $c_driveramount + $c_net_earned_on_ride;

                if (!$useramount) {
                    MyWallet::create([
                        'user_id' => $order->user_id,
                        'amount' => 0
                    ]);
                    $useramount = DB::table('my_wallet')->where('user_id', $order->user_id)->first();
                }


                $useramount = (int)$useramount->amount;

                if ($order->payment_type == 1) {
                    // if ($useramount < $total_amount) {
                    //     $arr['status'] = 0;
                    //     $arr['message'] = 'Customer has Insufficient funds in wallet to pay for delivery charge';
                    //     return response()->json($arr, 200);
                    // }

                    // $newuseramount = $useramount - $total_amount;
                    $newuseramount = $useramount - $order->total_amount;

                    Log::info("newuseramount : $newuseramount");

                    DB::table('my_wallet')->where('user_id', $order->driver_id)->update(['amount' => $newamount]);

                    $wallet_transaction = new WalletHistorys();
                    $wallet_transaction->user_id = $order->driver_id;
                    $wallet_transaction->amount = $net_earned_on_ride;
                    $wallet_transaction->status = 2;
                    $wallet_transaction->message = "Delivery Charge";
                    $wallet_transaction->save();


                    DB::table('my_wallet')->where('user_id', $order->user_id)->update(['amount' => $newuseramount]);

                    $wallet_transaction = new WalletHistorys();
                    $wallet_transaction->user_id = $order->user_id;
                    $wallet_transaction->amount = $net_earned_on_ride;
                    $wallet_transaction->status = 1;
                    $wallet_transaction->message = "Delivery Charge";
                    $wallet_transaction->save();
                } else if ($order->payment_type == 2) {
                    $newuseramount = $useramount - $order->total_amount;


                    DB::table('my_wallet')->where('user_id', $order->driver_id)->update(['c_amount' => $c_newamount]);

                    $wallet_transaction = new WalletHistorys();
                    $wallet_transaction->user_id = $order->driver_id;
                    $wallet_transaction->amount = $c_net_earned_on_ride;
                    $wallet_transaction->status = 2;
                    $wallet_transaction->message = "Delivery Charge";
                    $wallet_transaction->save();
                }


                $order->status = 4;
                $order->save();

                RideRequest::where('id', $order->ride_request_id)->update(['status' => "completed"]);


                // Notify Customer
                $this->sendNotification(
                    $order->user_id,
                    'Order Delivered Successfully!!',
                    "order-" . $order->id . " has been delivered successfully!!"
                );

                $arr['status'] = 1;
                $arr['message'] = 'Order Delivered Successfully!!';
                $arr['data'] =    $order;
                break;
            case 2:
                $order->status = 5;
                $order->save();
                // TODO: Notify vendor
                // update the ride request status
                RideRequest::where('id', $order->ride_request_id)->update(['status' => "picking_up"]);

                // Notify Customer
                $this->sendNotification(
                    $order->user_id,
                    'Picking Up Order!!',
                    "order-" . $order->id . " is being picked up by the delivery agent!!"
                );

                $arr['status'] = 1;
                $arr['message'] = 'Order Picked Up Successfully!!';
                $arr['data'] =    $order;
                break;
            case 3:
                $order->status = 6;
                $order->otp = rand(1111, 9999);
                $order->save();

                RideRequest::where('id', $order->ride_request_id)->update(['status' => "in_progress"]);

                // Notify Customer
                $this->sendNotification(
                    $order->user_id,
                    'Order Picked Up Successfully!!',
                    "order-" . $order->id . " has been picked up successfully!! and on its way to you!!"
                );

                $phone_number = "234" . substr($order->user->mobile, -10);
                $message = "order-" . $order->id . " has been picked up successfully!! use this pin to complete your order: " . $order->otp;

                // $this->sendSMSMessage(
                //     $phone_number,
                //     $message
                // );

                // if is_ride_other == 1 then notify the other user get the phone number of the other user FROM {"name":"Bobby Dan","phone_number":"089122901982"}
                if ($ride_request->is_ride_for_other == 1) {
                    // $jsonData = '{"name":"James","phone_number":"7030625895"}';
                    // var_dump($ride_request->other_rider_data);
                    // $other_user = json_decode($ride_request->other_rider_data, true);

                    // var_dump($other_user);
                    $other_user = $ride_request->other_rider_data['phone_number'];

                    $phoneNumber = $other_user;
                    // $other_user = json_decode($ride_request->other_rider_data);
                    // dd($other_user->phone_number);
                    $this->sendSMSMessage(
                        "+234" . substr($phoneNumber, -10),
                        "order-" . $order->id . " has been picked up successfully!! use this pin to complete your order: " . $order->otp
                    );
                }

                $arr['status'] = 1;
                $arr['message'] = 'Order In Progress';
                $arr['data'] =    $order;
                break;

            default:
                $arr['status'] = 0;
                $arr['message'] = 'Something went wrong!!';
                // $arr['data'] = false;
                break;
        }
        return response()->json($arr, 200);
    }


    function get_notification(Request $request)
    {

        $id = Auth::id();
        $query = DB::table("notifications")->where("user_id", $id)->where("type", 2)->get();
        if (count($query)) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $query;
        } else {
            $arr['status']    = 0;
            $arr['message']   = 'Notification not found!';
            $arr['data']      = null;
        }
        return response()->json($arr, 200);
    }

    function delete_notification(Request $request)
    {

        $id = Auth::id();
        $query = DB::table("notifications")->where("user_id", $id)->where("type", 2)->delete();
        if (1) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = null;
        } else {
            $arr['status']    = 0;
            $arr['message']   = 'something went wrong please try again';
            $arr['data']      = null;
        }
        return response()->json($arr, 200);
    }


    function get_bank_detail(Request $request)
    {

        $id = Auth::id();
        $query = DB::table("bank_details")->where("user_id", $id)->first();
        if ($query) {
            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $query;
        } else {
            $arr['status']    = 0;
            $arr['message']   = 'Notification not found!';
            $arr['data']      = null;
        }
        return response()->json($arr, 200);
    }


    function add_bank_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_holder_name' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required',

            'branch_name' => 'required'
        ]);

        if ($validator->fails()) {
            $arr['status']  = 0;
            $arr['message'] = "Validation Failed";
            $arr['data']    = NULL;
            return response()->json($arr, 200);
        }

        $id = auth::id();

        $check = DB::table('bank_details')->where('user_id', $id)->first();
        if (!$check) {
            $input = $request->all();
            $insertData = [
                "account_holder_name" => $request->account_holder_name,
                "account_number" => $request->account_number,
                "bank" => $request->bank_name,

                "branch" => $request->branch_name,
            ];
            $insertData['user_id'] = $id;

            $ins_id = DB::table('bank_details')->insertGetId($insertData);
            $data = DB::table('bank_details')->where('id', $ins_id)->first();
            $arr['status']  = 1;
            $arr['message'] = "success";
            $arr['data']    = $data;
            return response()->json($arr, 200);
        } else {
            $input = $request->all();
            $insertData = [
                "account_holder_name" => $request->account_holder_name,
                "account_number" => $request->account_number,
                "bank" => $request->bank_name,

                "branch" => $request->branch_name,
            ];

            $ins_id = DB::table('bank_details')->where('user_id', $id)->update($insertData);
            $data = DB::table('bank_details')->where('user_id', $id)->first();
            $arr['status']  = 1;
            $arr['message'] = "account detail updated successfully!";
            $arr['data']    = $data;
            return response()->json($arr, 200);
        }
    }


    public function login(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'type' => 'required',
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'username' => 'required',
            'password' => 'required',
            'location' => 'required',
            'location_lat' => 'required',
            'location_long' => 'required',
            // 'state' => 'required'
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->username);
            })
                ->where('type', $request->type)
                ->first();

            if (empty($user)) {
                $arr['status'] = 0;
                $arr['message'] = 'No user found';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            if (!Hash::check($request->password, $user->password)) {
                $arr['status'] = 0;
                $arr['message'] = 'Password is not matched';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }

            $data['type'] = $request->type;
            $data['device_id'] = $request->device_id;
            $data['device_type'] = $request->device_type;
            $data['device_name'] = $request->device_name;
            $data['device_token'] = $request->device_token;
            $data['location'] = $request->location;
            $data['location_lat'] = $request->location_lat;
            $data['location_long'] = $request->location_long;
            // $data['state'] = $request->state;

            if (strpos($request->username, '@')) {
                $data['email'] = $request->username;
            } else {
                $data['mobile'] = $request->username;
            }

            $token = $user->createToken('Pontus')->accessToken;

            User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token, 'device_id' => $request->device_id, 'device_type' => $request->device_type, 'device_name' => $request->device_name, 'device_token' => $request->device_token, 'location' => $request->location, 'location_lat' => $request->location_lat, 'location_long' => $request->location_long]);

            $userArr = User::where('id', $user->id)->get()->first();

            if ($user) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $userArr;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No user found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "Something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    public function update_profile(Request $request)
    {
        $validate = Validator::make($request->all(), ['name' => 'required', 'address' => 'required', 'profile' => 'required']);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 500);
        }

        try {
            $insert = $request->all();

            if (!empty($request->profile)) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('profile')->getClientOriginalName();
                $store = $request->file('profile')->storeAs('public/uploads/profile', $file_name);
                if ($store) {
                    $insert['profile'] = $file_name;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Profile image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 500);
                }
            }
            if (!empty($request->email)) {
                $email = User::where('id', '!=', Auth::id())->where('email', $request->email)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Email already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 500);
                }
            }
            if (!empty($request->mobile)) {
                $email = User::where('id', '!=', Auth::id())->where('mobile', $request->mobile)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Mobile already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 500);
                }
            }
            $user = User::where('id', Auth::id())->update($insert);

            if ($user) {
                $userdata = User::where('id', Auth::id())->first();
                $userdata->profile = !empty($userdata->profile) ? url('storage/uploads/profile') . '/' . $userdata->profile : '';
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data']['user'] = $userdata;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
            }

            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }

    //My orders API
    public function myOrders(Request $request)
    {
        try {

            $orders =
                DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    'rr.status as ride_status',
                    'rr.order_id as order_id',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")

                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                ->where('o.driver_id', Auth::id())
                ->where('o.status', '=', $request->status)

                ->orderBy('o.id', 'desc')->get();

            foreach ($orders as $key => $val) {
                $product_details =  EshopPurchaseDetail::where('order_id', $val->order_id)->get()->toArray();
                $val->products = $product_details != [] ? $product_details : [];
            }

            $order_list = $orders->toArray();
            if ($order_list == []) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                // $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order list found successfully";
                $arr['data'] = $order_list;
            }
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = env('APP_DEBUG') ? $e->getMessage() : "something went wrong";
            // $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }

    // orderDetails
    public function orderDetails(Request $request)
    {
        $validate = Validator::make($request->all(), ['order_id' => 'required']);
        try {
            if ($validate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = 'Validation Failed!!';
                // $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $orders = DB::table('orders as o')
                ->select(
                    'o.*',
                    'rr.start_address as ride_start_address',
                    'rr.end_address as ride_end_address',
                    'rr.start_latitude as ride_start_latitude',
                    'rr.start_longitude as ride_start_longitude',
                    'rr.end_latitude as ride_delivery_latitude',
                    'rr.end_longitude as ride_delivery_longitude',
                    'rr.ride_type as ride_type',
                    'rr.item_type as item_type',
                    'rr.item_categories as item_categories',
                    'rr.status as ride_status',
                    'rr.order_id as order_id',
                    's.store_name',
                    's.address as store_address',
                    's.lati as store_latitude',
                    's.longi as store_longitude',
                    'ua.location as delivery_address',
                    'ua.location_lat as delivery_latitude',
                    'ua.location_long as delivery_longitude',
                    'ua.mobile as delivery_mobile',
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.name')) ELSE NULL END AS other_rider_name"),
                    DB::raw("CASE WHEN rr.is_ride_for_other = 1 THEN TRIM(BOTH '\"' FROM JSON_EXTRACT(rr.other_rider_data, '$.phone_number')) ELSE NULL END AS other_rider_phone_number")
                )
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('users as ua', 'ua.id', 'o.user_id')
                ->leftJoin('ride_requests as rr', 'rr.id', 'o.ride_request_id') // Join the ride_request table
                ->where('o.driver_id', Auth::id())
                ->where('o.id', $request->order_id)->first();

            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                // $arr['data'] = NULL;
                return response()->json(
                    $arr,
                    200
                );
            }
            $product_details =  EshopPurchaseDetail::where('order_id', $orders->order_id)->get()->toArray();
            $orders->products = $product_details != [] ? $product_details : [];
            if (!$orders) {
                $arr['status'] = 0;
                $arr['message'] = "no data found";
                // $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = "order details found successfully";
                $arr['data'] = $orders;
            }
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "something went wrong";
            // $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
}
