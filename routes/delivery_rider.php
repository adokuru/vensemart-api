<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeliveryRiderController;
use App\Http\Controllers\API\BankDetailsController;

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
    Route::get('home', [DeliveryRiderController::class, 'dhome']);

    Route::get('all-orders', [DeliveryRiderController::class, 'all_orders']);
    Route::get('pending-orders', [DeliveryRiderController::class, 'pending_order']);
    Route::get('cancelled-orders', [DeliveryRiderController::class, 'cancel_order']);
    Route::get('completed-orders', [DeliveryRiderController::class, 'complete_order']);

    Route::post('accept_order', [DeliveryRiderController::class, 'accept_order']);
    Route::post('reject_order', [DeliveryRiderController::class, 'reject_order']);
    
    Route::post('complete_order_no_otp', [DeliveryRiderController::class, 'complete_order_noOtp']);

    
    Route::get('earning_management', [DeliveryRiderController::class, 'earning_management']);

    Route::post('get_single_order_details', [DeliveryRiderController::class, 'get_single_order_details']);

    Route::post('send_otp_for_product', [DeliveryRiderController::class, 'send_otp_for_product']);

    Route::post('on_off_status', [DeliveryRiderController::class, 'on_off_status']);

    Route::post('update_order_status', [DeliveryRiderController::class, 'update_order_status']);

    Route::get('get-profile', [DeliveryRiderController::class, 'd_get_profile']);

    Route::post('update-profile', [DeliveryRiderController::class, 'update_profile']);

    Route::post('db_update_profile', [DeliveryRiderController::class, 'db_update_profile']);
    Route::post('withdraw-request', [DeliveryRiderController::class, 'withdrawn_request']);
    Route::get('wallet-history', [DeliveryRiderController::class, 'total_earnings']);
    Route::get('aboutus_driver', [DeliveryRiderController::class, 'aboutus_driver']);
    Route::get('contactus_driver', [DeliveryRiderController::class, 'contactus_driver']);
    Route::get('allorderslist', [DeliveryRiderController::class, 'allorderslist']);
    Route::post('orderdetails_driver', [DeliveryRiderController::class, 'orderdetails_driver']);
    Route::post('acceptorders_driver', [DeliveryRiderController::class, 'acceptorders_driver']);
    Route::post('send_otp_to_delivery', [DeliveryRiderController::class, 'send_otp_to_delivery']);

    Route::post('complete_order_sms', [DeliveryRiderController::class, 'complete_order_sms']);
    Route::post('validate_order_details', [DeliveryRiderController::class, 'validate_order_details']);
   

    Route::get('get_notification', [DeliveryRiderController::class, 'get_notification']);

    Route::get('delete_notification', [DeliveryRiderController::class, 'delete_notification']);

    Route::get('assigned_order_list', [DeliveryRiderController::class, 'assigned_order_list']);

    Route::get('get_bank_detail', [DeliveryRiderController::class, 'get_bank_detail']);
    Route::get('test_noti', [DeliveryRiderController::class, 'test']);

    Route::post('add_bank_detail', [DeliveryRiderController::class, 'add_bank_detail']);

    Route::get('get-bank-details', [BankDetailsController::class, 'getBankDetails']);

    Route::post('add-bank-details', [BankDetailsController::class, 'addBankDetails']);
    
    Route::post('delete-bank-details', [BankDetailsController::class, 'deleteBankDetails']);
});