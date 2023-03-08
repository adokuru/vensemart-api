<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\SecondController;
use App\Http\Controllers\API\DeliveryBoyController;
use App\Http\Controllers\API\ProductsController;
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

Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);

Route::post('/customer/send-otp', [AuthController::class, 'send_otp']);


Route::post('send_recover_password_otp', [AuthController::class, 'send_recover_password_otp']);

Route::post('service_send_otp', [AuthController::class, 'service_send_otp']);

Route::post('verify_recover_password_otp', [AuthController::class, 'verify_recover_password_otp']);

Route::post('verify_account_otp', [AuthController::class, 'verify_account_otp']);

Route::post('update_password', [AuthController::class, 'update_password']);

Route::post('forget_password', [AuthController::class, 'forget_password']);





Route::group(['middleware' => 'auth:api'], function () {
    Route::post('update_profile', [AuthController::class, 'update_profile']);

    Route::get('get-location', [AuthController::class, 'get_location']);

    Route::post('set-location', [AuthController::class, 'update_location']);

    Route::post('change-password', [AuthController::class, 'change_password']);


    Route::get('user_details', [AuthController::class, 'user_details']);

    Route::get('notification_list', [ApiController::class, 'notification_list']);

    Route::get('delete_user_notification', [ApiController::class, 'delete_user_notification']);

    Route::post('home', [ApiController::class, 'home']);

    Route::post('search_product', [ApiController::class, 'search_product']);

    Route::post('near_by_store_list', [ApiController::class, 'near_by_store_list']);

    Route::post('search_product_for_perticular_category', [ApiController::class, 'search_product_for_perticular_category']);

    Route::post('search_product_for_perticular_sub_category', [ApiController::class, 'search_product_for_perticular_sub_category']);

    Route::post('get_product_details', [ApiController::class, 'get_product_details']);

    Route::get('category_list', [ApiController::class, 'category_list']);

    Route::get('products', [ApiController::class, 'category_list']);

    Route::post('sub_category_list', [ApiController::class, 'sub_category_list']);

    Route::post('products_list', [ApiController::class, 'products_list']);

    Route::post('add_cart', [ApiController::class, 'add_cart']);

    Route::get('cart_list', [ApiController::class, 'cart_list']);

    Route::post('update-cart', [ApiController::class, 'updateCart']);

    Route::post('remove-product', [ApiController::class, 'deleteCart']);

    Route::post('place-order', [ApiController::class, 'place_order']);

    Route::get('offer_list', [ApiController::class, 'offer_list']);
    Route::get('cancel_reason_question_list', [ApiController::class, 'cancel_reason_question_list']);
    Route::post('add_delivery_address', [ApiController::class, 'add_delivery_address']);
    Route::post('edit_delivery_address', [ApiController::class, 'edit_delivery_address']);
    Route::post('delete_delivery_address', [ApiController::class, 'delete_delivery_address']);
    Route::get('delivery_address_list', [ApiController::class, 'delivery_address_list']);

    Route::post('popular_category_and_shop_list', [ApiController::class, 'popular_category_and_shop_list']);

    Route::any('shop/{id}', [ApiController::class, 'shop']);

    Route::any('products/featured-stores', [ApiController::class, 'suggest_stores']);

    Route::post('add_favourite', [ApiController::class, 'add_favourite']);

    Route::get('favourite_list', [ApiController::class, 'favourite_list']);

    // Route::post('accept_order',[ApiController::class,'accept_order']);

    Route::any('my_orders', [ApiController::class, 'myOrders']);

    Route::any('products/my-orders', [ApiController::class, 'Orders']);



    Route::post('order_details', [ApiController::class, 'order_details']);
    Route::post('cancel_order', [ApiController::class, 'cancel_order']);
    Route::post('repeat_order', [ApiController::class, 'repeat_order']);
    Route::post('return_order', [ApiController::class, 'return_order']);

    Route::get('about_freshmor', [ApiController::class, 'about_freshmor']);
    Route::post('applycoupon', [ApiController::class, 'applycoupon']);
    Route::post('send_query', [ApiController::class, 'send_query']);
    Route::get('subscription_plan', [ApiController::class, 'subscription_plan']);
    Route::post('send_feedback', [ApiController::class, 'send_feedback']);
    Route::get('coupon_list', [ApiController::class, 'coupon_list']);
    Route::get('product_details/{id}', [ProductsController::class, 'product_details']);
    Route::post('product_details_orderid', [ApiController::class, 'product_details_orderid']);

    Route::get('products/{category_id}', [ProductsController::class, 'products']);

    Route::post('suggested_products', [ApiController::class, 'suggested_products']);

    Route::get('return_order_list', [ApiController::class, 'return_order_list']);
    Route::get('offer_product_list', [ApiController::class, 'offer_product_list']);

    Route::post('addaddress_user', [ApiController::class, 'addaddress_user']);
    Route::get('addresss_user_list', [ApiController::class, 'addresss_user_list']);
    Route::post('address_user_delete', [ApiController::class, 'address_user_delete']);


    Route::post('rate-service-provider', [ApiController::class, 'rateServiceProvider']);
});
