<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeliveryRiderController;




Route::post('rider/vehicle_registration', [DeliveryRiderController::class, 'vehicle_registration']);
Route::post('rider/register', [DeliveryRiderController::class, 'delivery_rider_register']);
Route::post('rider/login', [DeliveryRiderController::class, 'login']);


Route::group([
    'namespace' => 'Rider',
    'prefix' => 'rider',
    'middleware' => 'auth:api'
], function () {
    //Delivery Rider Route
    Route::post('onBoardRider', [DeliveryRiderController::class, 'onBoardRider']);
    Route::post('dhome', [DeliveryRiderController::class, 'dhome']);
    Route::get('all_orders', [DeliveryRiderController::class, 'all_orders']);
    Route::get('pending_order', [DeliveryRiderController::class, 'pending_order']);
    Route::get('cancel_order', [DeliveryRiderController::class, 'cancel_order']);
    Route::get('complete_order', [DeliveryRiderController::class, 'complete_order']);
    Route::get('accept_order', [DeliveryRiderController::class, 'accept_order']);
    Route::get('earning_management', [DeliveryRiderController::class, 'earning_management']);
    Route::post('get_single_order_details', [DeliveryRiderController::class, 'get_single_order_details']);
    Route::post('send_otp_for_product', [DeliveryRiderController::class, 'send_otp_for_product']);
    Route::post('on_off_status', [DeliveryRiderController::class, 'on_off_status']);
    Route::post('update_order_status', [DeliveryRiderController::class, 'update_order_status']);
    Route::get('d_get_profile', [DeliveryRiderController::class, 'd_get_profile']);
    Route::post('db_update_profile', [DeliveryRiderController::class, 'db_update_profile']);
    Route::post('withdrawn_request', [DeliveryRiderController::class, 'withdrawn_request']);
    Route::get('total_earnings', [DeliveryRiderController::class, 'total_earnings']);
    Route::get('aboutus_driver', [DeliveryRiderController::class, 'aboutus_driver']);
    Route::get('contactus_driver', [DeliveryRiderController::class, 'contactus_driver']);
    Route::get('allorderslist', [DeliveryRiderController::class, 'allorderslist']);
    Route::post('orderdetails_driver', [DeliveryRiderController::class, 'orderdetails_driver']);
    Route::post('acceptorders_driver', [DeliveryRiderController::class, 'acceptorders_driver']);
    Route::post('send_otp_to_delivery', [DeliveryRiderController::class, 'send_otp_to_delivery']);


    Route::get('get_notification', [DeliveryRiderController::class, 'get_notification']);
    Route::get('delete_notification', [DeliveryRiderController::class, 'delete_notification']);
    Route::get('assigned_order_list', [DeliveryRiderController::class, 'assigned_order_list']);
    Route::get('get_bank_detail', [DeliveryRiderController::class, 'get_bank_detail']);
    Route::get('test_noti', [DeliveryRiderController::class, 'test']);
    Route::post('add_bank_detail', [DeliveryRiderController::class, 'add_bank_detail']);
});