<?php

    // contact rider for delivery

    public function contactRiderForDelivery($orderID, $customerID, $deliveryID, $start_address, $end_address,  $isCustomerDelivery = 0, $Corddata = [])
    {


        try {

            // $orderDetails = \App\Models\EshopPurchaseDetail::where('order_id', $orderID)->first();

            $customer = User::where('id', $customerID)->first();

            $deliveryRider = User::where('id', $deliveryID)->first();

            $order = Orders::where('order_id', $orderID)->first();

            if (!$order) throw new \Exception('Order not found');

            // if (!$orderDetails) throw new \Exception('Order Details not found');

            if (!$customer) throw new \Exception('Customer not found');

            if (!$deliveryRider) throw new \Exception('Delivery Rider not found');
            // dd($deliveryRider->location_lat);


            $data = [
                "title" => "Contact Rider",
                "body" => "Customer " . $customer->name . " wants to contact you for order " . $order->order_id,
            ];

            // if ($isCustomerDelivery == 0) {
            //     $vendorNotification = [
            //         "title" => "Contact Vendor",
            //         "body" => "A Customer " . $customer->name . " wants to contact you for order " . $orderDetails->order_id . ", a rider will contact you soon, please visit your order details for more information.",
            //     ];

            //     $product = \App\Models\Products::find($orderDetails->product_id);

            //     if (!$product) return $this->sendError('Product not found', [], 422);

            //     $vendor = $this->getVendor($product->shop_id);
            //     $riders =  $this->requestRiderForDelivery($vendor->lati, $vendor->longi);

            // } else {
            $riders =  $this->requestRiderForDelivery($deliveryRider->location_lat, $deliveryRider->location_long);
            // }
            // if no rider is available
            if (!$riders) throw new \Exception('No Rider Available for this order');

            // Create a database for delivery request status
            $DeliveryRequestStatus1 = DeliveryRequestStatus::where('order_id', $order->id)->where('delivery_status', 0)->get();

            if ($DeliveryRequestStatus1->count() > 0) throw new \Exception('Rider already assigned');

            $DeliveryRequestStatus = DeliveryRequestStatus::where('order_id', $order->id)->where('delivery_status',  2)->get();

            // Delivery Status for Delivery Request Status =  0 Pending, 1, Accepted, 2 Rejected

            if ($DeliveryRequestStatus->count() > 0) {
                // get all riders that have gotten this request
                $riderIDs = $DeliveryRequestStatus->pluck('driver_id')->toArray();
                Log::info('269 - rider ids are ' . json_encode($riderIDs));

                // find the rider that is not in the array without using whereNotIn
                $rider = null;

                foreach ($riders as $item) {
                    if (in_array($item['id'], $riderIDs)) {
                        Log::info("276 - Bad Rider1: " . $item['id']);
                        continue;
                    }
                    Log::info("279 - Rider1: " . $item);
                    $rider = $item;
                    break;
                }

                Log::info("280 - Rider1: " . $rider);
                if (!$rider) return $this->sendError('No Rider Available for this order at the moment', [], 422);

                $result = DeliveryRequestStatus::create([
                    'order_id' => $order->id,
                    'customer_id' => $customerID,
                    // 'vendor_id' => $vendor->id,
                    'delivery_address' =>  $end_address,
                    'driver_id' => (int)$rider->id,
                    'delivery_status' => 0,
                ]);

                Log::info('riderid ' . $rider->id);



                $phone_Number = '+234' . substr($rider->mobile, -10);

                $message = "Dear Rider, you have a new delivery, please check vensemart rider app for details. ";

                $this->sendSMSMessage($rider->mobile, $message);

                // send notification to rider 
                $this->sendNotification($rider->id, "Order Request From Vensemart App", "You have been booked");
                Log::info("rider phonne, $rider->mobile");

                if ($rider->id == 0) throw new \Exception('No Rider Available for this order at the moment');
                if ($rider->id == null) throw new \Exception('No Rider Available for this order at the moment 2');
                // assign order to rider
                Log::info("302 - Rider2: " . $rider->id);

                Orders::where('order_id', $orderID)->update(['driver_id' => (int)$rider->id, 'status' => 2,]);


                Log::info('riderid ' . $rider->id);
                // send notification to rider 
                $this->sendNotification($rider->id, $data['title'], $data['body']);

                return $this->sendResponse('Rider requested successfully', $result);
            }

            if (!$riders) throw new \Exception('No Rider Available');


            if (!$riders[0]) throw new \Exception('No Rider Available');

            $rider = $riders[0];

            if (!$rider) throw new \Exception('No Rider Available');

            if ($rider) {
                $result = DeliveryRequestStatus::create([
                    'order_id' => $order->id,
                    'customer_id' => $customerID,
                    // 'vendor_id' => $vendor->id,
                    'delivery_address' => $end_address,
                    'driver_id' => (int)$rider->id,
                    'delivery_status' => 0,
                ]);
                // $this->sendSMSMessage("234" . substr($rider->mobile, -10), $data['body']);

                // assign order to rider
                Log::info("Rider1 here: " . $rider->mobile);
                Log::info("Pickup Address: " . $start_address);

                // generate otp
                // $otp = rand(1000, 9999);

                // $order = Orders::where('order_id', $orderID)->first();
                // $order->otp = $otp;
                // $order->save();

                // $message = "Dear Rider, you have a new delivery, please check vensemart rider app for details. OTP is $otp";

                // $this->sendSMSMessage("234" . substr($rider->mobile, -10), $message);



                Orders::where('order_id', $orderID)->update(['driver_id' => (int)$rider->id, 'status' => 2,]);
                // send notification to rider 

                $this->addUserWallet($rider->id, 1500);

                $this->sendNotification($rider->id, $data['title'], $data['body']);
                return $this->sendResponse('Rider requested successfully', $result);
            }
            throw new \Exception("No rider available");
        } catch (\Exception $e) {
            Log::error($e);
            throw new \Exception($e->getMessage());
        }
    }


        public function get_nearby_list(Request $request)
    {
        $driver_list = User::where('type', 2)->where('status', "1")->whereNotNull('location_lat')->whereNotNull('location_long');

        if ($request->has('latitude') && isset($request->latitude) && $request->has('longitude') && isset($request->longitude)) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            $radius = 50;
            // $driver_list = $driver_list->select(
            //     '*',
            //     DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance')
            // )
            //     ->having('distance', '<', $radius);
            $driver_list->selectRaw("id, name, status, is_online, type, location_lat, location_long, ( 6371 * acos( cos( radians($latitude) ) * cos( radians( location_lat ) ) * cos( radians( location_long ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( location_lat ) ) ) ) AS distance")
                ->having('distance', '<=', $radius)
                ->where('is_online', 1)
                ->orderBy('distance', 'asc');
        } else {
            $driver_list->selectRaw("id, name, status, is_online, type, location_lat, location_long");
        }

        $driver_list = $driver_list->get();

        if ($driver_list->count() > 0) {
            $arr['status'] = 1;
            $arr['message'] = "Driver list found successfully";
            $arr['data'] = $driver_list;
        } else {
            $arr['status'] = 0;
            $arr['message'] = "No driver found";
            $arr['data'] = NULL;
        }

        return $arr['data'];
    }

function saveRideHistory($data)
{
    // dd($data);
    $user_type = auth()->user()->user_type;
    $data['datetime'] = date('Y-m-d H:i:s');
    $mqtt_event = 'test_connection';
    $history_data = [];
    $sendTo = [];

    // $ride_request_id = $data['ride_request']->rid;
    $ride_request = RideRequest::find($data['ride_request']->ride_request_id);
    switch ($data['history_type']) {
        case 'new_ride_requested':
            // $data['history_message'] = __('message.ride.new_ride_requested');
            // $history_data = [
            //     'rider_id' => $ride_request->rider_id,
            //     'rider_name' => optional($ride_request->rider)->display_name ?? '',
            // ];
            $data['history_message'] = "New Ride Requested";
            $history_data = [
                'rider_id' => $data['ride_request']->driver_id,
                // 'rider_name' => optional($data['ride_request']->rider)->display_name ?? '',
            ];
            $sendTo = [];
            break;

        case 'no_drivers_available':
            # code...
            break;
        case 'accepted':
            $data['history_message'] = "Ride Accepted";
            $history_data = [
                'driver_id' => $data['ride_request']->driver_id,
                // 'driver_name' => optional($data['ride_request']->driver)->display_name ?? '',
            ];
            $mqtt_event = 'ride_request_status';
            // $sendTo = removeValueFromArray(['admin', 'rider'], $user_type);
            break;


            // ride is in progress from the start to the end location
        case 'in_progress':
            $data['history_message'] = "Ride in Progress";
            $history_data = [
                'driver_id' => $data['ride_request']->driver_id,
                // 'driver_name' => optional($data['ride_request']->driver)->display_name ?? '',
            ];
            $mqtt_event = 'ride_request_status';
            // $sendTo = removeValueFromArray(['admin', 'rider'], $user_type);
            break;

        case 'canceled':
            $data['history_message'] = __('message.ride.canceled');

            if ($ride_request->cancel_by == 'auto') {
                $history_data = [
                    'cancel_by' => $ride_request->cancel_by,
                    'rider_id' => $ride_request->rider_id,
                    // 'rider_name' => optional($ride_request->rider)->display_name ?? '',
                ];
            }



            if ($ride_request->cancel_by == 'driver') {
                $data['history_message'] = __('message.ride.driver_canceled');
                $history_data = [
                    'cancel_by' => $ride_request->cancel_by,
                    'driver_id' => $ride_request->driver_id,
                    // 'driver_name' => optional($ride_request->driver)->display_name ?? '',
                ];
            }

            $mqtt_event = 'ride_request_status';
            // $sendTo = removeValueFromArray(['admin', 'rider', 'driver'], $user_type);
            break;

        case 'driver_canceled':
            $data['history_message'] = __('message.ride.driver_canceled');
            $history_data = [
                'driver_id' => $ride_request->driver_id,
                // 'driver_name' => optional($ride_request->driver)->display_name ?? '',
            ];
            $mqtt_event = 'ride_request_status';
            // $sendTo = removeValueFromArray(['admin', 'rider'], $user_type);
            break;

        default:
            # code...
            break;
    }

    $data['history_data'] = json_encode($history_data);



    // if (count($sendTo) > 0) {


    $notify_data = new \stdClass();
    $notify_data->success = true;
    $notify_data->success_type = $data['history_type'];
    $notify_data->success_message = $data['history_message'];

    // dd($data);


    // if ($user != null) {
    // dd($mqtt_event . '_' . $data['ride_request']->driver_id, json_encode($notify_data));


    if ($data['history_type'] != 'new_ride_requested') {
        dispatch(new NotifyViaMqtt($mqtt_event . '_' . $data['ride_request']->user_id, json_encode($notify_data)));
    }




    // }

}



    // save order request
    public function save_order_request(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            // 'customer_id' => 'required',
            // 'driver_id' => 'required',
            'total_amount' => 'required',
            'start_latitude' => 'required',
            'start_longitude' => 'required',
            'start_address' => 'required',
            'end_latitude' => 'required',
            'end_longitude' => 'required',
            'end_address' => 'required',
            'payment_type' => 'required',
            'delivery_charge' => 'required',
            "is_ride_for_other" => 'required',
            "ride_type" => 'required',
            'item_type' => 'required',
            'item_categories' => 'required',

        ]);

        $user_id = Auth::id();

        // try {
        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }

        $data = $request->all();


        $req = new Request([
            "latitude" => $request->start_latitude,
            "longitude" => $request->start_longitude,
        ]);



        // Call the get_drivers_list function and pass the new request
        $response = $this->get_nearby_list($req);
        // dd($req, $request->all(), $response);


        // Check if a driver was found
        // if ($response != null && $response->count() > 0) {
        //     $rider = $response->first();
        // } else {
        //     $arr['status'] = 0;
        //     $arr['message'] = 'Sorry!! No Rider Found';
        //     $arr['data'] = NULL;
        // }

        DB::beginTransaction();

        Log::info('This works here');

        $invoice_no  =  rand(1000000000, 999999999999);
        $total_amount = 0;
        $net_amount = 1000;

        $taxes = $net_amount * 7.5 / 100;

        $total_amount = $net_amount + $request->delivery_charge + $taxes;


        // save information for ride request
        // $ride_data['rider_id'] = $user_id;
        // $ride_data['driver_id'] = $rider->id;
        $ride_data['start_latitude'] = $request->start_latitude;
        $ride_data['start_longitude'] = $request->start_longitude;
        $ride_data['start_address'] = $request->start_address;
        $ride_data['end_latitude'] = $request->end_latitude;
        $ride_data['end_longitude'] = $request->end_longitude;
        $ride_data['end_address'] = $request->end_address;
        $ride_data['is_ride_for_other'] = $request->is_ride_for_other ? 1 : 0;
        $ride_data['status'] = "new_ride_requested";
        // if request ride for other is 1
        if ($request->is_ride_for_other == 1) {
            $ride_data['other_rider_data'] = json_encode($request->other_rider_data);
        }
        $ride_data['ride_type'] = $request->ride_type;
        $ride_data['item_type'] = $request->item_type;
        $ride_data['item_categories'] = $request->item_categories;


        $result2 = DB::table('ride_requests')->insertGetId($ride_data);
        // dd($result2);


        $order_data['invoice_no'] = $invoice_no;
        // $order_data['order_type'] = 2;
        $order_data['user_id'] = $user_id;
        $order_data['driver_id'] = $response != null && $response->count() > 0 ? $response->first()->id : null;
        $order_data['ride_request_id'] = $result2;
        $order_data['net_amount'] = $net_amount;
        $order_data['total_amount'] = $total_amount;
        $order_data['taxes'] =  $taxes;
        $order_data['delivery_charge'] = $request->delivery_charge;
        $order_data['payment_type'] = $request->payment_type;
        $order_data['payment_status'] = 1;
        $order_data['status'] = 1;
        $order_data['purchase_date'] = date('Y-m-d');
        $order_data['order_id'] = "FM" . rand(10000, 99999);
        $order_data['transaction_id'] = rand(1000000000, 999999999999);




        $result1 = DB::table('orders')->insert($order_data);

        if ($result1) {

            DB::commit();
            $orderIdd = $order_data['order_id'];


            $data_noti = array('title' => "Order Delivery Request Placed", 'message' => "order placed successfully!  order  ID is  $orderIdd", 'user_id' => Auth::id());
            $this->sendNotification(Auth::id(), "Order Placed", "Order Placed Successfully ");
            $this->sendNotification(1105, "Order Placed", "Order Rider");

            // Check if a driver was found
            // if ($rider && $rider->status == 1) {
            if ($response != null && $response->count() > 0) {
                $rider = $response->first();

                $this->contactRiderForDelivery($orderIdd, $user_id, $rider->id, $ride_data['start_address'], $ride_data['end_address']);
            } else {
                $Corddata = [
                    'lati' => $ride_data['start_latitude'],
                    'longi' => $ride_data['start_longitude'],
                ];

                $this->contactRiderAndVendor($orderIdd, $user_id, $Corddata);
            }
            // } else {
            //     $arr['status'] = 0;
            //     $arr['message'] = 'Sorry!! No Rider Found';
            //     $arr['data'] = NULL;
            // }

            $order = DB::table('orders')->where('order_id', $orderIdd)->first();

            $arr['status'] = 1;
            $arr['message'] = 'Ride Request Placed Successfully';
            $arr['data'] = [
                'order_id' => $invoice_no,
                // rider details
                'riderequest_id' => $order->id,

            ];

            return response()->json($arr, 200);
        } else {
            DB::rollback();
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        // } catch (\Exception $e) {
        //     $arr['status'] = 0;
        //     $arr['message'] = 'Sorry!! Something Went Wrong';
        //     $arr['data'] = NULL;
        // }

        return response()->json($arr, 200);
    }



if (!$riders[0]) throw new \Exception('No Rider Available');

$rider = $riders[0];

if (!$rider) throw new \Exception('No Rider Available');

if ($rider) {
    // $result = DeliveryRequestStatus::create([
    //     'order_id' => $order->id,
    //     'customer_id' => $customerID,
    //     // 'vendor_id' => $vendor->id,
    //     'delivery_address' => $end_address,
    //     'driver_id' => (int)$rider->id,
    //     'delivery_status' => 0,
    // ]);
    // // $this->sendSMSMessage("234" . substr($rider->mobile, -10), $data['body']);

    // // assign order to rider
    // Log::info("Rider1 here: " . $rider->mobile);
    // Log::info("Pickup Address: " . $start_address);

    // generate otp
    // $otp = rand(1000, 9999);

    // $order = Orders::where('order_id', $orderID)->first();
    // $order->otp = $otp;
    // $order->save();

    // $message = "Dear Rider, you have a new delivery, please check vensemart rider app for details. OTP is $otp";

    // $this->sendSMSMessage("234" . substr($rider->mobile, -10), $message);



    // Orders::where('order_id', $orderID)->update(['driver_id' => (int)$rider->id, 'status' => 2,]);
    // send notification to rider 

    // $this->addUserWallet($rider->id, 1500);

    $this->sendNotification($rider->id, $data['title'], $data['body']);
    return $this->sendResponse('Rider requested successfully', $result);
}
throw new \Exception("No rider available");


   // public function existinguserdelete($id)
    // {
    //     DB::table('users')->where('id', $id)->delete();
    //     ?>
    //     <script>
    //         alert('User Deleted Successfully!!');
    //         window.location.href = "<?php echo url('admin/manageexisting_user'); ?>";
    //     </script>
    // <?php
    // }

    // public function delete_driver($id)
    // {
    //     DB::table('users')->where('id', $id)->delete();
    // ?>
    //     <script>
    //         alert('User Deleted Successfully!!');
    //         window.location.href = "<?php echo url('admin/manageexisting_drivers'); ?>";
    //     </script>
    // <?php
    // }