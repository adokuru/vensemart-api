<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
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


Route::match(['get','post'],'/admin',[AuthController::class,'login']);
Route::match(['get','post'],'/login',[AuthController::class,'login']);
Route::match(['get','post'],'admin/login',[AuthController::class,'login']);

/********************After login *************************/
Route::group(['namespace' => 'Admin','prefix'=>'admin', 'middleware'=>['afterLoginAuth']], function () {
    /**************************Admin Data**************************************/
    Route::match(['get','post'],'dashboard',[AdminController::class,'dashboard']);
    Route::match(['get','post'],'logout',[AuthController::class,'logout']);
    Route::match(['get','post'], '/update-password', [AuthController::class, 'updatePassword']);
    Route::match(['get','post'], 'profile', [AuthController::class, 'profile'])->name('profile');
    Route::any('/profile/changepass',[AuthController::class,'change_password']);
    /**********************End Admin Data********************************************/
    
    /*****************************Existing User***************************************/
    Route::any('manageexisting_user',[AdminController::class,'manageexisting_user']);
    Route::any('existinguser/edit/{key}',[AdminController::class,'existinguseredit']);
    Route::get('existinguser/delete/{key}',[AdminController::class,'existinguserdelete']);
    /*****************************End Existing User*************************************************/
    
    /***************************** Vendor***************************************/
    Route::get('manage_vendor',[AdminController::class,'vendors_list']);
    Route::get('edit-vendor/{id}',[AdminController::class,'edit_vendor']);
    Route::post('verify_vendor',[AdminController::class,'verify_vendor']);
    
    
    /*****************************Manage New User***********************************/
    Route::get('managenew_user',[AdminController::class,'managenew_user']);
    Route::any('new-user/edit/{key}',[AdminController::class,'managenew_edit']);
    Route::get('newuserdelete/{key}',[AdminController::class,'newuserdelete']);
    /********************************End Manage New User*****************************/
    
    /************************************Manage New Drivers******************************/
    Route::get('managenew_drivers',[AdminController::class,'managenew_drivers']);
    Route::get('new-driver/view/{key}',[AdminController::class,'viewnew_driver']);
    Route::any('addnew_driver',[AdminController::class,'addnew_driver']);
    /*************************************End Manage New Drivers**************************/
    
    /********************************Manage Existing Drivers*****************************/
    Route::get('manageexisting_drivers',[AdminController::class,'manageexisting_drivers']);
    Route::get('existing-driver/view/{key}',[AdminController::class,'viewexisting_driver']);
    /*********************************Manage New Drivers**********************************/
    
    /**************************Existing Service Provider*****************************/
    Route::get('exist_serviceprovider',[AdminController::class,'exist_serviceprovider']);
    Route::get('exist_serviceprovider/change_status_of_serviceprovider',[AdminController::class,'existchange_status_of_serviceprovider']);
    Route::get('exist_serviceprovider/viewserviceprovider/{key}',[AdminController::class,'viewserviceprovider']);
    /**************************End Existing Service Provider***************************/
    
    /**********************New Service Provider*******************************/
    Route::get('new_serviceprovider',[AdminController::class,'new_serviceprovider']);
    Route::get('new_serviceprovider/change_status_of_serviceprovider',[AdminController::class,'change_status_of_serviceprovider']);
    Route::get('new_serviceprovider/viewserviceprovider_new/{key}',[AdminController::class,'viewserviceprovider_new']);
    /**********************End Service Provider********************************/
    
    /********************************Manage CMS****************************/
    Route::any('about-us/update',[AdminController::class,'aboutus_update']);
    Route::any('contactus/update',[AdminController::class,'contactus_update']);
    /********************************End Manage CMS***********************/
    
    
    /*********************Manage Rejected Driver List************************/
    Route::get('managerejected_driverlist',[AdminController::class,'managerejected_driverlist']);
    Route::get('rejected_drivers/change_status_of_rejecteddriver',[AdminController::class,'change_status_of_rejecteddriver']);
    Route::any('rejected_driver/view/{key}',[AdminController::class,'rejected_driver_view']);
    Route::get('rejected_driver/delete/{key}',[AdminController::class,'rejected_driver_delete']);
    /*************************End Manage Rejected Driver List***************/
    
    
    /*****************************Manage Rejected Service Provider***********************/
    Route::get('managerejectedservice_providerlist',[AdminController::class,'managerejectedservice_providerlist']);
    Route::get('rejectedservice_provider/change_status_of_rejectedserviceprovider',[AdminController::class,'change_status_of_rejectedserviceprovider']);
    Route::any('managerejectedservice_provider/view/{key}',[AdminController::class,'managerejectedservice_provider_view']);
    Route::get('managerejectedservice_provider/delete/{key}',[AdminController::class,'managerejectedservice_provider_delete']);
    /*********************************End Manage Rejected Service Provider****************/
    
    
    /************************Manage Category**************************/
    Route::get('managecategory/listing',[AdminController::class,'managecategory']);
    Route::any('category/add',[AdminController::class,'category_add']);
    Route::any('category/edit/{key}',[AdminController::class,'categoryedit']);
    Route::get('category/delete/{key}',[AdminController::class,'categorydelete']);
    /***************************End Manage Category*********************/
    
    /***************************Manage SubCategory*****************************/
    Route::get('managesubcategory/listing',[AdminController::class,'managesubcategory']);
    Route::any('managesubcategory/add',[AdminController::class,'managesubcategory_add']);
    Route::any('managesubcategory/edit/{key}',[AdminController::class,'managesubcategoryedit']);
    Route::get('managesubcategory/delete/{key}',[AdminController::class,'managesubcategorydelete']);
    /***************************End Manage SubCategory**************************/
    
    /*********************************Manage Pending Orders*****************************/
    Route::get('order/in-process/listing',[AdminController::class,'managependingorderslisting']);
    Route::get('order/in_process/view/{key}',[AdminController::class,'managependingordersview']);
    Route::any('order/in_process/edit/{key}',[AdminController::class,'managependingordersedit']);
    /*********************************End Manage Orders************************/
    
    
    /***************************Manage Completed Orders************************/
    Route::get('order/completed_orders/listing',[AdminController::class,'managecompeletedordreslisting']);
    Route::any('order/completed_orders/view_orders/{key}',[AdminController::class,'managecompletedvieworders']);
    Route::any('order/completed_orders/editorders/{key}',[AdminController::class,'managecomplete_editorders']);
    /***************************End Manage Completed Orders**********************/
    
    /****************************Manage Terms & Condition********************/
    Route::any('termscondition/update',[AdminController::class,'termsconditionupdate']);
    /*****************************End Terms & Condition**********************/
    
    /************************Manage Service Provider Category********************/
     Route::get('manageservicecategory_list',[AdminController::class,'manageservicecategory_list']);
     Route::any('manageservice_category/add',[AdminController::class,'manageservicecategory_add']);
     Route::any('manageservice_category/edit/{key}',[AdminController::class,'manageservicecategory_edit']);
     Route::get('manageservice_category/delete/{key}',[AdminController::class,'manageservicecategory_delete']);
    /**************************End Manage Service Provider Category**************/
    
    
    /**************************Manage Withdrawl Request****************************/
    Route::get('managewithdrawl_request/listing',[AdminController::class,'managewithdrawlrequest_listing']);
    Route::any('managewithdrawl_request/edit/{key}',[AdminController::class,'managewithdrawlrequest_edit']);
    /****************************End Manage Withdrawl Request***********************/
    
    /****************************Manage Country************************/
    Route::get('country/listing',[AdminController::class,'countrylisting']);
    Route::any('country/add',[AdminController::class,'countryadd']);
    Route::any('country/edit/{key}',[AdminController::class,'countryedit']);
    Route::get('country/delete/{key}',[AdminController::class,'countrydelete']);
    /*****************************End Manage Country*******************/
    
    /****************************Manage States************************/
    Route::get('states/listing',[AdminController::class,'statelisting']);
    Route::any('states/add',[AdminController::class,'stateadd']);
    Route::any('states/edit/{key}',[AdminController::class,'stateedit']);
    Route::get('states/delete/{key}',[AdminController::class,'statedelete']);
    /*****************************End Manage States*******************/
    
    /***************************Manage City***************************/
    Route::get('cities/listing',[AdminController::class,'citylisting']);
    Route::any('cities/add',[AdminController::class,'cityadding']);
    Route::get('cities/delete/{key}',[AdminController::class,'citydelete']);
    Route::any('cities/edit/{key}',[AdminController::class,'citiesedit']);
    /*************************End Manage City**************************/
    Route::get('state_list/{key}',[AdminController::class,'state_list']);
    
});
