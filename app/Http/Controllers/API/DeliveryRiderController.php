<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\SendNotification;
use App\Traits\SendMessage;
use Exception;

class DeliveryRiderController extends Controller
{

    use SendNotification;
    use SendMessage;

    function test(Request $request)
    {
        $data = array('title' => 'test', 'message' => 'this is', 'user_id' => 71);
        $this->send_to_user($data);
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
            DB::table('users')->where('id', Auth::id())->update(['location_lat' => $request->location_lat, 'location_long' => $request->location_long]);
            $total_order = DB::table('orders')->where('driver_id', Auth::id())->count();
            $total_earning = DB::table('my_wallet')->where('user_id', Auth::id())->sum('amount');
            $availibility = DB::table('users')->where('id', Auth::id())->where('status', '1')->first();
            $today_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->whereDate('o.order_date', date('Y-m-d'))->get()->toArray();
            $data['total_order'] = $total_order != 0 ? $total_order : 0;
            $data['total_earning'] = $total_earning != 0 ? number_format((float)$total_earning, 2, '.', '') : 0.00;
            $data['today_order'] = $today_order != [] ? $today_order : [];
            $data['availibility'] = $availibility != '' ? "yes" : "no";

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
            $all_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->leftJoin('stores as s', 's.id', 'o.shop_id')
                ->leftJoin('user_address as ua', 'ua.id', 'o.address_id')
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
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->where('o.status', '2')->get()->toArray();
            if ($pending_order == []) {
                $arr['status'] = 0;
                $arr['message'] = 'No data.';
                $arr['data'] = NULL;
            } else {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $pending_order;
            }
            return response()->json($arr, 200);
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
            $cancel_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->where('o.status', '5')->get()->toArray();
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
            $complete_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->where('o.status', '4')->get()->toArray();
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
            $accept_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->where('o.status', '2')->get()->toArray();
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


    public function assigned_order_list(Request $request)
    {
        try {
            $accept_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
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
                ->select('o.*', 'users.name', 'users.mobile', 'users.location_lat', 'users.location_long', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",s.store_image)  as store_image'))
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
                ->select('p.*', 'c.category_name', 'sc.name as sub_category_name', 's.store_name', 'u.name as uom_name', DB::raw('CONCAT("' . url('storage/app/product_images') . '","/",product_image)  as product_image'))
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

    public function update_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), ['order_id' => 'required', 'status' => 'required', 'payment_status' => 'required']);
        try {
            if ($validator->fails()) {
                $arr['status']  = 0;
                $arr['message'] = "Validation Failed";
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }

            $order_status['status'] = $request->status;
            $order_status['payment_status'] = $request->payment_status;
            DB::table('orders')->where('id', $request->order_id)->update($order_status);
            $order_status['order_id'] = $request->order_id;
            DB::table('orders_status')->insert(['order_id' => $request->order_id, 'status' => $request->status]);
            if ($request->status  == 4) {
                //get order detail
                $order_de = DB::table("orders")->where('order_id', $request->order_id)->first();
                $ins_d =  $noti_data = array('title' => 'Order Delivered', 'message' => "Your Order $request->order_id is  Delivered Successfully", 'user_id' => $order_de->user_id);
                $this->send_to_user($noti_data);
                $ins_d1 =   $noti_data1 = array('title' => 'Order Delivered', 'message' => "Your Order Delivered Successfully", 'user_id' => $order_de->driver_id);
                $this->send_to_user($noti_data1);
                $ins_d['type'] =  1;
                $ins_d1['type'] =  2;
                DB::table("notifications")->insert($ins_d);
                DB::table("notifications")->insert($ins_d1);
            }
            $get_user_data =  DB::table('users')->select('id', 'name', 'email')->where('id', $order_de->user_id)->first();
            if ($get_user_data) {
                $data['name'] = $get_user_data->name;
                $data['msg'] = "Order  Delivered: your  Order " . $bookingId . " is  Delivered Successfully";
                $data['subject'] = "Order  Delivered";

                \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
            }

            $arr['status'] = 1;
            $arr['message'] = 'Status update Successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status']  = 0;
            $arr['message'] = 'something went wrong';
            $arr['data']    = NULL;
        }
        return response()->json($arr, 200);
    }



    function d_get_profile(Request $request)
    {
        $id = Auth::id();
        if ($id) {
            $profile = User::select('*', DB::raw('CONCAT("' . url('uploads/profile') . '","/",profile)  as profile'))->find($id);
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
        $rule = ['name' => 'required', 'email' => 'required', 'mobile' => 'required', 'vehicle_type' => 'required', 'vehicle_number' => 'required', 'dl_number' => 'required', 'insurance_number' => 'required'];
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
            $userdata->profile =  !empty($userdata->profile)  ? url('uploads/profile') . '/' . $userdata->profile : '';
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
        $id  = Auth::id();
        $user = User::find($id);

        try {
            $amount = $request->amount;
            $count = DB::table('my_wallet')->where('user_id', $id)->count();
            if ($count > 0) {
                $walletamount = DB::table('my_wallet')->where('user_id', $id)->first();
                $driveramount = (int)$walletamount->amount;

                if ($amount <= $driveramount) {
                    $status = 1;
                    $data = array('driver_id' => $id, 'amount' => $amount, 'status' => $status);
                    DB::table('request_withdrawn_amounts')->insert($data);
                    $arr['status'] = 1;
                    $arr['message'] = 'Request is Sent to the Admin Successfully!!';
                    $arr['data'] = true;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Sorry!! You did not have insufficent balance';
                    $arr['data'] = NULL;
                }
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Sorry!! You did not have balance in your wallet';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
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

                $data['transactionhistory'] = DB::table('wallet_historys')->where('user_id', $userId)->get();
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
                ->select('orders.*', 'users.name as user_name', DB::raw('CONCAT("' . url('storage/app/shop_images') . '","/",stores.store_image)  as store_image'))
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
                //   $noti_data = array('title'=>'Order Accepted','message'=>"Order Accepted Successfully, order id is $orderid",'user_id'=>71);
                //   $this->send_to_user($data);
            }
            if ($type == "2") {
                DB::table('orders')->where('order_id', $orderid)->update(['reject_driver_id' => Auth::id(), 'driver_id' => null]);
                $arr['status'] = 1;
                $arr['message'] = 'Order Cancelled Successfully!!';
                $arr['data'] = true;
            }
            /*
           $get_book_data =  DB::table('orders')->select('id','user_id','order_id')->where('order_id',$orderid)->first();
                if($get_book_data){
                    // get user record
                      $get_user_data =  DB::table('users')->select('id','name','email')->where('id',$get_book_data->user_id)->first();
                    if($get_user_data){
                        if($type=="1"){
                            $data['name'] = $get_user_data->name;
                            $data['msg'] = "Order Request Accepted : your service " .$orderid. " is  Accepted ";
                            $data['subject'] = "Order Accepted";
                        }else{
                            $data['name'] = $get_user_data->name;
                            $data['msg'] = "Order Request Rejected : your service " .$orderid. " is  Rejected ";
                            $data['subject'] = "Order Rejected";
                        }
                        \Mail::to($get_user_data->email)->send(new \App\Mail\SendOrderMail($data));
                    }
                }
           */
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

                \Mail::to($request->username)->send(new \App\Mail\SendOtpMail($data));
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

            if (strpos($request->username, '@')) {
                $data['email'] = $request->username;
            } else {
                $data['mobile'] = $request->username;
            }

            $token = $user->createToken('Pontus')->accessToken;

            User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token, 'device_id' => $request->device_id, 'device_type' => $request->device_type, 'device_name' => $request->device_name, 'device_token' => $request->device_token]);

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
}
