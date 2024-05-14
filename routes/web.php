<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Facades\Agent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/test', function () {
    return "Vensemart Version 1.0";
});

Route::get('/', function () {
    $store = Stores::where('franchise_id', auth()->user()->user_id)->first();

    $storeId = $store->id;

    $productsCount = Products::where('shop_id', $store->id)->count();

    $ordersCount = Orders::where('shop_id', $store->id)->count();

    $salesCount = Orders::where('shop_id', $store->id)->where('status', 4)->count();
    $pendingCount = Orders::where('shop_id', $store->id)->where('status', 3)->count();

    return view(
        'nk1/index',
        [
            "productsCount" => $productsCount,
            "ordersCount" => $ordersCount,
            "salesCount" => $salesCount,
            "pendingCount" => $pendingCount,
        ]
    );
})->middleware(['auth', 'verified']);

Auth::routes();

Route::get(
    '/home',
    function () {
        return view('outer_files/dup');
    }
)->middleware(['auth', 'verified']);

Route::get(
    '/vendor',
    function () {
        return view('outer_files/dup');
    }
)->middleware(['auth', 'verified']);

Route::get('/product-form', function () {

    return view('outer_files/product-form');
});

// Route::post('submit', [UploadController::class, 'submit']);

Route::get('/product', function () {

    return view('outer_files/uploadfile');
});

Route::get('/api/ref', function (Request $request) {
    $referralCode = $request->query('ref');

    // Use the extracted referral code for further processing
    // For example, you can append it to the store link

    $referralLink = 'https://api.vensemart.com/api/ref?';

    if (Agent::isMobile()) {
        if (Agent::is('iPhone') || Agent::is('iPad')) {
            // Check if the iOS app is installed
            if (Agent::is('iPhone') && Agent::match('VensemartCustomer')) {
                return redirect('vensemartcustomer://?ref=' . $referralCode);
            } elseif (Agent::is('iPad') && Agent::match('VensemartCustomer')) {
                return redirect('vensemartcustomeripad://?ref=' . $referralCode);
            } else {
                // Redirect to iOS store with referral code
                $storeLink = 'https://apps.apple.com/us/app/vensemart-customer/id1670924558?ref=' . $referralCode;
                return redirect($storeLink);
            }
        } elseif (Agent::isAndroidOS()) {
            // Check if the Android app is installed
            if (Agent::match('VensemartCustomer')) {
                return redirect('vensemartcustomer://?ref=' . $referralCode);
            } else {
                // Redirect to Android store with referral code
                $storeLink = 'https://play.google.com/store/apps/details?id=com.vensemart.vensemart&ref=' . $referralCode;
                return redirect($storeLink);
            }
        } else {
            // Redirect to the referral link with referral code
            $storeLink = $referralLink . '=' . $referralCode;
            return redirect($storeLink);
        }
    } else {
        // Redirect to the referral link with referral code
        $storeLink = $referralLink . '=' . $referralCode;
        return redirect($storeLink);
    }
});

Route::get('/dashboard', function () {
    return view('outer_files/dup');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/markets', function () {
    return view('outer_files/markets');
})->middleware(['auth', 'verified'])->name('markets');

Route::get('/collectors', function () {
    return view('outer_files/collectors');
})->middleware(['auth', 'verified'])->name('collectors');

Route::get('/edit-product', function () {
    return view('outer_files/product-edit');
})->middleware(['auth', 'verified'])->name('product-edit');

Route::get('/duplicate', function () {
    return view('outer_files/duplicate');
})->middleware(['auth', 'verified'])->name('duplicate');

Route::get('/product-details', function () {
    return view('nk1/product-list');
})->middleware(['auth', 'verified'])->name('product-details');

Route::get('/orders-list', function () {

    return view('nk1/orders');
})->middleware(['auth', 'verified'])->name('orders');

Route::get('/dup', function () {
    return view('outer_files/dup');
})->middleware(['auth', 'verified'])->name('dup');

Route::get('/index', function () {

    $store = Stores::where('franchise_id', auth()->user()->user_id)->first();

    $storeId = $store->id;

    $productsCount = Products::where('shop_id', $store->id)->count();

    $ordersCount = Orders::where('shop_id', $store->id)->count();

    $salesCount = Orders::where('shop_id', $store->id)->where('status', 4)->count();
    $pendingCount = Orders::where('shop_id', $store->id)->where('status', 3)->count();

    return view(
        'nk1/index',
        [
            "productsCount" => $productsCount,
            "ordersCount" => $ordersCount,
            "salesCount" => $salesCount,
            "pendingCount" => $pendingCount,
        ]
    );
})->middleware(['auth', 'verified'])->name('index');

Route::get('/duppp', function () {
    return view('outer_files/dupppp');
})->middleware(['auth', 'verified'])->name('duppp');

Route::get('/bank', function () {
    return view('outer_files/bank');
})->middleware(['auth', 'verified'])->name('bank');

Route::get('/orders', function () {
    return view('outer_files/orders');
})->middleware(['auth', 'verified'])->name('orders');

Route::get('/dupp ', function () {
    return view('outer_files/dupp');
})->middleware(['auth', 'verified'])->name('dupp');

Route::get('/records', function () {
    return view('outer_files/records');
})->middleware(['auth', 'verified'])->name('records');

Route::middleware('auth')->group(function () {

    Route::get(

        '/profile',
        function () {

            return view('outer_files/profile');
        }
    );

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::match(['get', 'post'], '/admin', [AuthController::class, 'login']);
// Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], 'admin/login', [AuthController::class, 'login']);

/********************After login *************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin-email']], function () {
    /**************************Admin Data**************************************/
    Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard']);
    Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout']);
    Route::match(['get', 'post'], '/update-password', [AuthController::class, 'updatePassword']);
    Route::match(['get', 'post'], 'profile', [AuthController::class, 'profile'])->name('profile');
    Route::any('/profile/changepass', [AuthController::class, 'change_password']);
    /**********************End Admin Data********************************************/

    /*****************************Existing User***************************************/
    Route::any('manageexisting_user', [AdminController::class, 'manageexisting_user']);
    Route::any('manageexisting_user_refer', [AdminController::class, 'manageexisting_user_refer']);
    Route::any('existinguser/edit/{key}', [AdminController::class, 'existinguseredit']);
    Route::get('existinguser/delete/{key}', [AdminController::class, 'existinguserdelete']);
    /*****************************End Existing User*************************************************/

    /***************************** Vendor***************************************/
    Route::get('manage_vendor', [AdminController::class, 'vendors_list'])->name('vendors_list');
    Route::get('edit-vendor/{id}', [AdminController::class, 'edit_vendor']);
    Route::post('verify_vendor', [AdminController::class, 'verify_vendor']);
    Route::get('existingvendor/delete/{key}', [AdminController::class, 'existingvendordelete']);

    /***************************** Stores***************************************/
    Route::get('manage_store', [AdminController::class, 'stores_list'])->name('stores_list');
    Route::get('edit-store/{id}', [AdminController::class, 'edit_store']);
    Route::post('verify_store', [AdminController::class, 'verify_store']);
    Route::get('existingvendor/delete/{key}', [AdminController::class, 'existingstoredelete']);

    /***************************** Banks***************************************/
    Route::get('manage_bank', [AdminController::class, 'banks_list'])->name('banks_list');
    Route::get('edit-bank/{id}', [AdminController::class, 'edit_bank']);
    Route::post('verify_store', [AdminController::class, 'verify_store']);
    Route::get('existingvendor/delete/{key}', [AdminController::class, 'existingstoredelete']);

    /***************************** Products***************************************/
    Route::get('manage_product', [AdminController::class, 'products_list'])->name('products_list');
    Route::get('edit-product/{id}', [AdminController::class, 'edit_product']);
    Route::post('verify_product', [AdminController::class, 'verify_product']);
    Route::get('existingproduct/delete/{key}', [AdminController::class, 'existingproductdelete']);

    /*****************************Manage New User***********************************/
    Route::get('managenew_user', [AdminController::class, 'managenew_user']);
    Route::any('new-user/edit/{key}', [AdminController::class, 'managenew_edit']);
    Route::get('newuserdelete/{key}', [AdminController::class, 'newuserdelete']);
    /********************************End Manage New User*****************************/

    /************************************Manage New Drivers******************************/
    Route::get('managenew_drivers', [AdminController::class, 'managenew_drivers']);
    Route::get('new-driver/view/{key}', [AdminController::class, 'viewnew_driver']);
    Route::any('addnew_driver', [AdminController::class, 'addnew_driver']);
    Route::any('existing-driver/delete/{key}', [AdminController::class, 'delete_driver'])->name('existing-driver.delete');

    /*************************************End Manage New Drivers**************************/

    /********************************Manage Existing Drivers*****************************/
    Route::get('manageexisting_drivers', [AdminController::class, 'manageexisting_drivers']);
    Route::get('existing-driver/view/{key}', [AdminController::class, 'viewexisting_driver']);
    /*********************************Manage New Drivers**********************************/

    /**************************Existing Service Provider*****************************/
    Route::get('exist_serviceprovider', [AdminController::class, 'exist_serviceprovider']);
    Route::get('exist_serviceprovider/change_status_of_serviceprovider', [AdminController::class, 'existchange_status_of_serviceprovider']);
    Route::get('exist_serviceprovider/viewserviceprovider/{key}', [AdminController::class, 'viewserviceprovider']);

    Route::get('exist_serviceprovider/existingserviceprovider_delete/{key}', [AdminController::class, 'deleteserviceprovider']);

    /**************************End Existing Service Provider***************************/

    /**********************New Service Provider*******************************/
    Route::get('new_serviceprovider', [AdminController::class, 'new_serviceprovider']);
    Route::get('new_serviceprovider/change_status_of_serviceprovider', [AdminController::class, 'change_status_of_serviceprovider']);
    Route::get('new_serviceprovider/viewserviceprovider_new/{key}', [AdminController::class, 'viewserviceprovider_new']);
    /**********************End Service Provider********************************/

    /********************************Manage CMS****************************/
    Route::any('about-us/update', [AdminController::class, 'aboutus_update']);
    Route::any('contactus/update', [AdminController::class, 'contactus_update']);
    /********************************End Manage CMS***********************/

    /*********************Manage Rejected Driver List************************/
    Route::get('managerejected_driverlist', [AdminController::class, 'managerejected_driverlist']);
    Route::get('rejected_drivers/change_status_of_rejecteddriver', [AdminController::class, 'change_status_of_rejecteddriver']);
    Route::any('rejected_driver/view/{key}', [AdminController::class, 'rejected_driver_view']);
    Route::get('rejected_driver/delete/{key}', [AdminController::class, 'rejected_driver_delete']);
    /*************************End Manage Rejected Driver List***************/

    /*****************************Manage Rejected Service Provider***********************/
    Route::get('managerejectedservice_providerlist', [AdminController::class, 'managerejectedservice_providerlist']);
    Route::get('rejectedservice_provider/change_status_of_rejectedserviceprovider', [AdminController::class, 'change_status_of_rejectedserviceprovider']);
    Route::any('managerejectedservice_provider/view/{key}', [AdminController::class, 'managerejectedservice_provider_view']);
    Route::get('managerejectedservice_provider/delete/{key}', [AdminController::class, 'managerejectedservice_provider_delete']);
    /*********************************End Manage Rejected Service Provider****************/

    /************************Manage Category**************************/
    Route::get('managecategory/listing', [AdminController::class, 'managecategory']);
    Route::any('category/add', [AdminController::class, 'category_add']);
    Route::any('category/edit/{key}', [AdminController::class, 'categoryedit']);
    Route::get('category/delete/{key}', [AdminController::class, 'categorydelete']);
    /***************************End Manage Category*********************/

    /***************************Manage SubCategory*****************************/
    Route::get('managesubcategory/listing', [AdminController::class, 'managesubcategory']);
    Route::any('managesubcategory/add', [AdminController::class, 'managesubcategory_add']);
    Route::any('managesubcategory/edit/{key}', [AdminController::class, 'managesubcategoryedit']);
    Route::get('managesubcategory/delete/{key}', [AdminController::class, 'managesubcategorydelete']);
    /***************************End Manage SubCategory**************************/

    /*********************************Manage Pending Orders*****************************/
    Route::get('order/in-process/listing', [AdminController::class, 'managependingorderslisting']);
    Route::get('order/in_process/view/{key}', [AdminController::class, 'managependingordersview']);
    Route::any('order/in_process/edit/{key}', [AdminController::class, 'managependingordersedit']);
    /*********************************End Manage Orders************************/

    /***************************Manage Completed Orders************************/
    Route::get('order/completed_orders/listing', [AdminController::class, 'managecompeletedordreslisting']);
    Route::any('order/completed_orders/view_orders/{key}', [AdminController::class, 'managecompletedvieworders']);
    Route::any('order/completed_orders/editorders/{key}', [AdminController::class, 'managecomplete_editorders']);
    /***************************End Manage Completed Orders**********************/

    /*********************************Manage Pending Service Orders*****************************/
    Route::get('serviceorder/in-process/listing', [AdminController::class, 'managependingserviceorderslisting']);
    Route::get('serviceorder/in_process/view/{key}', [AdminController::class, 'managependingserviceordersview']);
    Route::any('serviceorder/in_process/edit/{key}', [AdminController::class, 'managependingserviceordersedit']);
    /*********************************End Manage Service Orders************************/

    /***************************Manage Completed Service Orders************************/
    Route::get('serviceorder/completed_serviceorders/listing', [AdminController::class, 'managecompletedserviceorderslisting']);
    Route::any('order/completed_orders/view_orders/{key}', [AdminController::class, 'managecompletedvieworders']);
    Route::any('order/completed_orders/editorders/{key}', [AdminController::class, 'managecomplete_editorders']);
    /***************************End Manage Completed Service Orders**********************/

    /***************************Manage Cancelled Service Orders************************/
    Route::get('serviceorder/cancelled_serviceorders/listing', [AdminController::class, 'managecancelledserviceorderslisting']);
    Route::any('order/completed_orders/view_orders/{key}', [AdminController::class, 'managecompletedvieworders']);
    Route::any('order/completed_orders/editorders/{key}', [AdminController::class, 'managecomplete_editorders']);
    /***************************End Manage Cancelled Service Orders**********************/

    /****************************Manage Terms & Condition********************/
    Route::any('termscondition/update', [AdminController::class, 'termsconditionupdate']);
    /*****************************End Terms & Condition**********************/

    /************************Manage Service Provider Category********************/
    Route::get('manageservicecategory_list', [AdminController::class, 'manageservicecategory_list']);
    Route::any('manageservice_category/add', [AdminController::class, 'manageservicecategory_add']);
    Route::any('manageservice_category/edit/{key}', [AdminController::class, 'manageservicecategory_edit']);
    Route::get('manageservice_category/delete/{key}', [AdminController::class, 'manageservicecategory_delete']);
    /**************************End Manage Service Provider Category**************/

    /**************************Manage Withdrawl Request****************************/
    Route::get('managewithdrawl_request/listing', [AdminController::class, 'managewithdrawlrequest_listing']);
    Route::any('managewithdrawl_request/edit/{key}', [AdminController::class, 'managewithdrawlrequest_edit']);
    /****************************End Manage Withdrawl Request***********************/

    /****************************Manage Country************************/
    Route::get('country/listing', [AdminController::class, 'countrylisting']);
    Route::any('country/add', [AdminController::class, 'countryadd']);
    Route::any('country/edit/{key}', [AdminController::class, 'countryedit']);
    Route::get('country/delete/{key}', [AdminController::class, 'countrydelete']);
    /*****************************End Manage Country*******************/

    /****************************Manage States************************/
    Route::get('states/listing', [AdminController::class, 'statelisting']);
    Route::any('states/add', [AdminController::class, 'stateadd']);
    Route::any('states/edit/{key}', [AdminController::class, 'stateedit']);
    Route::get('states/delete/{key}', [AdminController::class, 'statedelete']);
    /*****************************End Manage States*******************/

    /***************************Manage City***************************/
    Route::get('cities/listing', [AdminController::class, 'citylisting']);
    Route::any('cities/add', [AdminController::class, 'cityadding']);
    Route::get('cities/delete/{key}', [AdminController::class, 'citydelete']);
    Route::any('cities/edit/{key}', [AdminController::class, 'citiesedit']);
    /*************************End Manage City**************************/
    Route::get('state_list/{key}', [AdminController::class, 'state_list']);
});
