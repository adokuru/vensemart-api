<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\SecondController;
use App\Http\Controllers\API\DeliveryBoyController;
use App\Http\Controllers\API\NewRoutesController;
use App\Http\Controllers\API\ServiceProviderController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*******************************************/
Route::get('service_type', [ServiceProviderController::class, 'service_type']);

Route::get('terms-conditions', [ApiController::class, 'terms_condition']);

Route::get('services', [ServiceProviderController::class, 'service_type']);

Route::get('about-us', [SecondController::class, 'aboutus']);

Route::get('contact-us', [SecondController::class, 'contactus']);

Route::get('faqs', [SecondController::class, 'faqs']);


require __DIR__ . '/customer_app.php';
require __DIR__ . '/delivery_rider.php';
require __DIR__ . '/service_provider_app.php';

Route::post('forgot-password', [AuthController::class, 'send_otp']);
Route::post('forgot-password-change', [AuthController::class, 'forgot_password']);

Route::any('test/{phone_number}', [Controller::class, 'DojahVerifyNumber']);

Route::post('send-support-message', [NewRoutesController::class, 'send_support_message']);