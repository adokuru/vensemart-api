<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryRequests;
use App\Models\DeliveryRequestStatus;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeliveryCustomerController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'device_name' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|string',
            'device_id' => 'required|string',
            'mobile' => 'required|string|unique:users'
        ]);

        $users = User::where(function ($query) use ($request) {
            $query->where('email', $request->email);
            $query->orwhere('mobile', $request->mobile);
        })
            ->first();

        if ($users) {
            return $this->sendError(null, 'User already exists.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'device_name' => $request->device_name,
            'device_token' => $request->device_token,
            'device_type' => $request->device_type,
            'device_id' => $request->device_id,
            'type' => 5
        ]);

        $token = $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->sendResponse('User registered successfully.', $response);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|string',
            'device_id' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError(null, 'The provided credentials are incorrect.');
        }

        $user->device_name = $request->device_name;
        $user->device_token = $request->device_token;
        $user->device_type = $request->device_type;
        $user->device_id = $request->device_id;
        $user->save();

        $token = $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->sendResponse('User logged in successfully.', $response);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'gender' => 'string',
            'address' => 'string',
        ]);

        $user = auth()->user();

        $user = User::where('id', $user->id)->first();

        if (!$user) {
            return $this->sendError(null, 'User not found.');
        }

        // update when data is not empty
        $user->name = $request->input('name') ?? $user->name;
        $user->gender = $request->input('gender') ?? $user->gender;
        $user->address = $request->input('address') ?? $user->address;

        $user->save();

        return $this->sendResponse('User updated successfully.', $user);
    }

    public function rateDriver(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'driver_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'string'
        ]);

        $user = auth()->user();

        if (!$user) {
            return $this->sendError(null, 'User not found.');
        }

        $driver = User::where('id', $request->driver_id)->first();

        if (!$driver) {
            return $this->sendError(null, 'Driver not found.');
        }

        $order = Orders::where('id', $request->order_id)->first();

        if (!$order) {
            return $this->sendError(null, 'Order not found.');
        }

        $delivery = DeliveryRequestStatus::where('order_id', $request->order_id)->first();

        if (!$delivery) {
            return $this->sendError(null, 'Delivery not found.');
        }

        $delivery->rating = $request->rating;
        $delivery->comment = $request->comment;

        $delivery->save();

        return $this->sendResponse('Rating submitted successfully.', $delivery);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        $user = User::where('id', $user->id)->first();

        if (!$user) {
            return $this->sendError(null, 'User not found.');
        }

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return $this->sendError(null, 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->input('new_password'));

        $user->save();

        return $this->sendResponse(null, 'Password updated successfully.');
    }

    public function requestDeliveryPrice(Request $request)
    {
        $request->validate([
            'from_lat',
            'to_lat',
            'from_lng',
            'to_lng'
        ]);

        // Find the distance from from cords to to cords

        $distance = $this->getDistance($request->from_lat, $request->from_lng, $request->to_lat, $request->to_lng);

        $deliveryChargePerKm = 300;

        $deliveryfee = $distance * $deliveryChargePerKm;

        $taxes = $deliveryfee * 7.5 / 100;

        $total_amount = $deliveryfee + $taxes;

        return $this->sendResponse(
            'Delivery Fee',
            $total_amount
        );
    }

    public function requestDelivery(Request $request)
    {
        try {
            $request->validate([
                'deliveryPrice',
                'from_address',
                'from_lat',
                'to_lat',
                'from_lng',
                'to_lng',
                'to_address',
                'size'
            ]);

            DB::beginTransaction();
            $user_id = Auth::id();
            $net_amount  = $request->deliveryPrice;
            $invoice_no  =  rand(1000000000, 999999999999);
            $taxes = $net_amount * 7.5 / 100;
            $total_amount = $net_amount + $taxes;
            $order_data['invoice_no'] = $invoice_no;
            $order_data['user_id'] = $user_id;
            $order_data['net_amount'] = $net_amount;
            $order_data['total_amount'] = $total_amount;
            $order_data['taxes'] =  $taxes;
            $order_data['delivery_charge'] = $request->deliveryPrice;
            $order_data['total_item'] = 1;
            $order_data['payment_status'] = 0;
            $order_data['status'] = 1;
            $order_data['order_id'] = "FM" . rand(10000, 99999);
            $order_data['transaction_id'] = rand(1000000000, 999999999999);


            DB::table('orders')->insert($order_data);

            $orderIdd = $order_data['order_id'];

            $data_noti = array('title' => "Order Placed", 'message' => "order placed successfully!  order  ID is  $orderIdd", 'user_id' => Auth::id());
            $this->sendNotification(Auth::id(), "Order Placed", "Order Placed Successfully ");
            DB::table('notifications')->insert(['user_id' => Auth::id(), 'title' => "Order Placed", 'message' => $data_noti['message'], 'type' => 1]);
            $Corddata = [
                'lati' => $request->from_lat,
                'longi' => $request->from_lng,
            ];
            $this->contactRiderAndVendor($orderIdd, $user_id, 1, $Corddata);
            DB::commit();

            return $this->sendResponse('Order Booked');
        } catch (\Exception $e) {
            DB::rollback();
            return  $this->sendError($e, $e->getMessage(), 500);
        }
    }

    public function deliveryRequest()
    {
        $orders = Orders::where('user_id', Auth::id())->where('status', "!=", "7")->latest()->get();

        $this->sendResponse('Delivery Requests', $orders);
    }

    public function cancelDeliveryRequest(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'reason' => 'string'
        ]);

        $order = Orders::where('id', $request->order_id)->firstOrFail();

        $order->status = 7;
        $order->cancel_reason = $request->reason;
        $order->save();

        $driverDelivery = DeliveryRequestStatus::where('order_id', $order->id)->get();

        foreach ($driverDelivery as $item) {
            $item->delivery_status = 2;
            $item->comment = $request->reason;
            $item->save();
        }

        return $this->sendResponse(
            'Order Cancelled',
            $order
        );
    }
}
