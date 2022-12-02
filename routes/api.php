<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\SecondController;
use App\Http\Controllers\API\DeliveryBoyController;
use App\Http\Controllers\API\ServiceProviderController;
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

Route::get('terms_condition', [ApiController::class, 'terms_condition']);
Route::get('service_type', [ServiceProviderController::class, 'service_type']);


require __DIR__ . '/customer_app.php';
require __DIR__ . '/delivery_rider.php';