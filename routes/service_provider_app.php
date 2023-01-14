<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ServiceProviderController;



Route::post('service_pro_register', [AuthController::class, 'service_pro_register']);
Route::post('service_pro_login', [AuthController::class, 'service_pro_login']);


Route::group(['middleware' => 'auth:api'], function () {

    // OTP Verification Routes
    Route::post('send-otp', [AuthController::class, 'send_otp']);
    Route::post('verify-otp', [AuthController::class, 'verify_otp']);


    // Service Provider Onboarding

    Route::post('service-pro-onboarding-1', [ServiceProviderController::class, 'serviceprovider_onboarding']);
    Route::post('service-pro-onboarding-2', [ServiceProviderController::class, 'serviceprovider_onboarding_2']);

    //Service Provider User Side

    Route::post('homeservice', [ServiceProviderController::class, 'homeservice']);

    Route::get('service-provider-home', [ServiceProviderController::class, 'homeServiceProvider']);

    Route::get('serviceprovider_list/{cat_id}', [ServiceProviderController::class, 'serviceprovider_list']);

    Route::get('service-provider/{id}', [ServiceProviderController::class, 'service_provider_by_ID']);

    Route::get('allserviceslist', [ServiceProviderController::class, 'allserviceslist']);

    Route::get('get-all-service-categories', [ServiceProviderController::class, 'allserviceslist']);

    Route::get('get-trending-services', [ServiceProviderController::class, 'trendingServices']);

    Route::post('book-service', [ServiceProviderController::class, 'bookingservice']);


    Route::post('paymentbookingservice', [ServiceProviderController::class, 'paymentbookingservice']);

    Route::get('bookingsservicelist/{booking_type}', [ServiceProviderController::class, 'bookingsservicelist']);

    Route::post('cancelbooking', [ServiceProviderController::class, 'cancelbooking']);

    Route::get('cancelreasonlist', [ServiceProviderController::class, 'cancelreasonlist']);

    Route::post('searchserviceprovider', [ServiceProviderController::class, 'searchserviceprovider']);

    Route::get('receved_request_list', [ServiceProviderController::class, 'receved_request_list']);

    Route::get('upcomming_request_list', [ServiceProviderController::class, 'upcomming_request_list']);

    Route::get('cancel_request_list', [ServiceProviderController::class, 'cancel_request_list']);

    Route::get('completed-bookings', [ServiceProviderController::class, 'complete_request_list']);

    Route::post('complete_request_detail', [ServiceProviderController::class, 'complete_request_detail']);

    Route::get('confirm_request_list', [ServiceProviderController::class, 'confirm_request_list']);

    Route::post('receved_request_detail', [ServiceProviderController::class, 'receved_request_detail']);

    Route::post('upcomming_request_detail', [ServiceProviderController::class, 'upcomming_request_detail']);

    Route::post('cancel_request_detail', [ServiceProviderController::class, 'cancel_request_detail']);

    Route::post('confirm_request_detail', [ServiceProviderController::class, 'confirm_request_detail']);

    Route::get('get_profile', [ServiceProviderController::class, 'get_profile']);

    Route::post('service_update_profile', [ServiceProviderController::class, 'service_update_profile']);

    Route::get('get-banks', [ServiceProviderController::class, 'getBankList']);

    Route::post('validate-bank-account', [ServiceProviderController::class, 'validate_bank_account']);

    Route::post('add_service_bank_detail', [ServiceProviderController::class, 'add_service_bank_detail']);

    Route::get('get_bank_details', [ServiceProviderController::class, 'get_bank_details']);

    Route::post('update_bank_details', [ServiceProviderController::class, 'update_bank_details']);

    Route::post('service_change_password', [ServiceProviderController::class, 'service_change_password']);

    Route::post('gps_on', [ServiceProviderController::class, 'gps_on']);

    Route::post('user_setting', [ServiceProviderController::class, 'user_setting']);

    Route::post('cancel_booking', [ServiceProviderController::class, 'cancel_booking']);

    Route::get('service_notification', [ServiceProviderController::class, 'service_notification']);

    Route::get('delete_service_provider_notification', [ServiceProviderController::class, 'delete_service_provider_notification']);

    Route::post('user_contact_details', [ServiceProviderController::class, 'user_contact_details']);

    Route::post('service_home', [ServiceProviderController::class, 'service_home']);

    Route::post('service_booking_accept', [ServiceProviderController::class, 'service_booking_accept']);

    Route::post('service_booking_complete', [ServiceProviderController::class, 'service_booking_complete']);

    Route::get('service_subscription_plans', [ServiceProviderController::class, 'service_subscription_plans']);




    Route::post('accept-reject-bookings', [ServiceProviderController::class, 'upcomming_booking_accept_reject']);

    Route::get('payment_history', [ServiceProviderController::class, 'payment_history']);

    Route::post('service_paymet_request', [ServiceProviderController::class, 'service_paymet_request']);

    Route::get('service_paymet_widhral_list', [ServiceProviderController::class, 'service_paymet_widhral_list']);

    Route::post('buy_subscription_plan', [ServiceProviderController::class, 'buy_subscription_plan']);

    Route::any('get_subscription_plan', [ServiceProviderController::class, 'get_subscription_plan']);
});

Route::any('service/provider-subscription-plans', [ServiceProviderController::class, 'service_subscription_plans']);