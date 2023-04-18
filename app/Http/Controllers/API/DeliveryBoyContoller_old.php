<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class DeliveryBoyController extends Controller
{
    public function delivery_boy_register(Request $request)
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
            unset($data['aadhar_number']);
            unset($data['aadhar_picture']);
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
                        'aadhar_number' => 'required',
                        'aadhar_picture' => 'required',
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
                    if (!empty($vehicle_details['aadhar_picture'])) {
                        $file_name1 = date('dmy') . rand(1, 4) . $request->file('aadhar_picture')->getClientOriginalName();
                        $store = $request->file('aadhar_picture')->move('uploads/all_image', $file_name1);
                        if ($store) {
                            $vehicle_details['aadhar_picture'] = $file_name1;
                        } else {
                            $arr['status'] = 0;
                            $arr['message'] = 'Aadhar image not uploaded!!';
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
            $total_order = DB::table('orders')->where('driver_id', Auth::id())->count();
            $total_earning = DB::table('my_wallet')->where('user_id', Auth::id())->sum('amount');
            $availibility = DB::table('users')->where('id', Auth::id())->where('status', '1')->first();
            $today_order = DB::table('orders as o')
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
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
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
                ->join('stores as s', 's.id', 'o.shop_id')
                ->join('user_address as ua', 'ua.id', 'o.address_id')
                ->where('o.driver_id', Auth::id())->get()->toArray();
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
                ->select('o.*')
                ->where('o.driver_id', Auth::id())->where('o.status', '1')->get()->toArray();
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
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
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
                ->select('o.*', 's.store_name', 's.address as store_address', 'ua.type as address_type', 'ua.address as delivery_address', DB::raw('CONCAT("' . url('storage/shop_images') . '","/",s.store_image)  as store_image'))
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
        $request->validate([
            'order_id' => 'required',
        ]);

        try {
            $accept_order = Orders::where('id', $request->order_id)->update(['status' => '3']);

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
    //update order status API
    public function update_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), ['order_id' => 'required', 'status' => 'required']);
        try {
            if ($validator->fails()) {
                $arr['status']  = 0;
                $arr['message'] = "Validation Failed";
                $arr['data']    = NULL;
                return response()->json($arr, 200);
            }

            $order_status['status'] = $request->status;
            DB::table('orders')->where('id', $request->order_id)->update($order_status);
            $order_status['order_id'] = $request->order_id;
            DB::table('orders_status')->insert($order_status);
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
            'aadhar_number' => 'required',
            'aadhar_picture' => 'required',
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
            if (!empty($vehicle_details['aadhar_picture'])) {
                $file_name1 = date('dmy') . rand(1, 4) . $request->file('aadhar_picture')->getClientOriginalName();
                $store = $request->file('aadhar_picture')->move('uploads/all_image', $file_name1);
                if ($store) {
                    $vehicle_details['aadhar_picture'] = $file_name1;
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
}