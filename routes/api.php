<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\SecondController;
use App\Http\Controllers\API\DeliveryBoyController;
use App\Http\Controllers\API\NewRoutesController;
use App\Http\Controllers\API\ServiceProviderController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\BankDetailsController;
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


Route::get('/api/ref', function () {
    $referralCode = request()->query('');

    // Call the detectDeviceAgent function passing the referral code
    return app(SecondController::class)->detectDeviceAgent($referralCode);
});


Route::post('product_image', [ProductsController::class, 'product_image']);

// Route::post('product_image',[ProductsController::class, 'product_image']);


require __DIR__ . '/customer_app.php';
require __DIR__ . '/delivery_rider.php';
require __DIR__ . '/service_provider_app.php';
require __DIR__ . '/delivery_customer.php';

Route::post('forgot-password', [AuthController::class, 'send_otp']);
Route::post('forgot-password-change', [AuthController::class, 'forgot_password']);


Route::post('send-test', [AuthController::class, 'sendMeMessage']);


Route::any('test', [Controller::class, 'contactRiderAndVendor']);

Route::post('send-support-message', [NewRoutesController::class, 'send_support_message']);

Route::post('test-notification', [NewRoutesController::class, 'test_notification']);

Route::post('delete-account', [NewRoutesController::class, 'delete_account']);


Route::get('get-banks', [BankDetailsController::class, 'get_banks']);

Route::post('get-account-name', [BankDetailsController::class, 'getBankAccountName']);