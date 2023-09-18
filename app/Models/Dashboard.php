<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ServicebookUser;
use Carbon\Carbon;


class Dashboard extends Model
{
    use HasFactory;
    


    public function get_total_yesterday_new_user(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }

    
    public function get_total_yesterday_pending_services(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 1)->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }

    public function get_total_daily_pending_services(){

        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 1)->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_pending_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 1)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_pending_services(){
        
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 1)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_pending_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 1)->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }




    public function get_total_yesterday_completed_services(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 3)->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }

    public function get_total_daily_completed_services(){

        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 3)->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_completed_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 3)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_completed_services(){
        
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 3)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_completed_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 3)->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }



    public function get_total_yesterday_cancelled_services(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 5)->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }

    public function get_total_daily_cancelled_services(){

        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 5)->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_cancelled_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 5)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_cancelled_services(){
        
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 5)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_cancelled_services(){
       
        // DB::enableQueryLog();
        $result  = DB::table('servicebook_user')->where('servicebook_user.status', 5)->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }




    public function get_total_daily_existing_user(){

        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_existing_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }






    public function get_total_yesterday_existing_vendors(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('poc_registration')->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }


    public function get_total_daily_existing_vendors(){

        // DB::enableQueryLog();
        $result  = DB::table('poc_registration')->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_existing_vendors(){
       
        // DB::enableQueryLog();
        $result  = DB::table('poc_registration')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_vendors(){
        
        // DB::enableQueryLog();
        $result  = DB::table('poc_registration')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_vendors(){
       
        // DB::enableQueryLog();
        $result  = DB::table('poc_registration')->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }



    function countReferredUsersWithBookedServiceYesterday() {
        $yesterday = Carbon::yesterday();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereHas('servicebookUsers', function ($query) use ($yesterday) {
                $query->whereDate('created_at', $yesterday);
            })
            ->count();
    
        return $count;
    }
    
    function countReferredUsersWithBookedServiceToday() {
        $today = Carbon::today();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereHas('servicebookUsers', function ($query) use ($today) {
                $query->whereDate('created_at', $today);
            })
            ->count();
    
        return $count;
    }
    
    function countReferredUsersWithBookedServiceThisWeek() {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereHas('servicebookUsers', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            })
            ->count();
    
        return $count;
    }
    
    function countReferredUsersWithBookedServiceThisMonth() {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereHas('servicebookUsers', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            })
            ->count();
    
        return $count;
    }
    
    function countReferredUsersWithBookedServiceThisYear() {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereHas('servicebookUsers', function ($query) use ($startOfYear, $endOfYear) {
                $query->whereBetween('created_at', [$startOfYear, $endOfYear]);
            })
            ->count();
    
        return $count;
    }


    function countReferredUsersYesterday() {
        $yesterday = Carbon::yesterday();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereDate('created_at', $yesterday)
            ->count();
    
        return $count;
    }
    
    function countReferredUsersToday() {
        $today = Carbon::today();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereDate('created_at', $today)
            ->count();
    
        return $count;
    }
    
    function countReferredUsersThisWeek() {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
    
        return $count;
    }
    
    function countReferredUsersThisMonth() {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
    
        return $count;
    }
    
    function countReferredUsersThisYear() {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
    
        $count = User::whereNotNull('referred_by_id')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->count();
    
        return $count;
    }
    




    
    public function get_total_daily_new_user(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_new_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_new_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_new_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }  
    
      public function get_total_daily_existing_driver(){

        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 2)->where('users.created_at', '>=', Carbon::now()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_existing_driver(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 2)->where('users.created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_driver(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 2)->where('users.created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_driver(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 2)->where('users.created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    
    public function get_total_daily_new_driver(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  =DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 1)->where('users.created_at', '>=', Carbon::now()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_new_driver(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 1)->where('users.created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_new_driver(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 1)->where('users.created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_new_driver(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->select("users.id as user_idcount","users.name","users.email","users.mobile","users.type","users.profile","vehicle_details.*")->leftJoin("vehicle_details","vehicle_details.user_id",'=',"users.id")->where('users.type', "2")->where('vehicle_details.isVerify', 1)->where('users.created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('users.id');
        // dd(DB::getQueryLog());die;
        return $result;
    } 
    
    
    function ordered_placed_daily(){

        // DB::enableQueryLog();
        $result  = DB::table('orders')->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;  
    }
    
    function ordered_placed_weekly(){
       // DB::enableQueryLog();
        $result  = DB::table('orders')->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    
    function ordered_placed_monthly(){
         // DB::enableQueryLog();
        $result  = DB::table('orders')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    
    function ordered_placed_yearly(){
       // DB::enableQueryLog();
        $result  = DB::table('orders')->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function ordered_placed_total(){
       // DB::enableQueryLog();
        $result  = DB::table('orders')->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    
    function total_daily_new_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    
    function total_weekly_new_product(){
       // DB::enableQueryLog();
        $result  = DB::table('products')->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function total_monthly_new_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function total_yearly_new_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function total_new_product(){
         // DB::enableQueryLog();
        $result  = DB::table('products')->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    
    function total_daily_out_of_stack_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('quantity','<=',0)->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    
    function total_weekly_out_of_stack_product(){
       // DB::enableQueryLog();
        $result  = DB::table('products')->where('quantity','<=',0)->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function total_monthly_out_of_stack_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('quantity','<=',0)->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }
    function total_yearly_out_of_stack_product(){
        // DB::enableQueryLog();
        $result  = DB::table('products')->where('quantity','<=',0)->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }

    function total_out_of_stack_product(){
         // DB::enableQueryLog();
        $result  = DB::table('products')->where('quantity','<=',0)->count('id');
        // dd(DB::getQueryLog());die;
        return $result; 
    }

    


    public function get_total_daily_existing_service_user(){

        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_existing_service_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_service_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_service_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    


    public function get_total_yesterday_new_service_user(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::yesterday()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }


    public function get_total_daily_new_service_user(){
        $array = ['1','2'];
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }



    public function get_total_weekly_new_service_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_new_service_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_new_service_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }  


   function total_upcoming_services(){
    // DB::enableQueryLog();
   $result  = DB::table('users')->where('type',3)->count('id');
   // dd(DB::getQueryLog());die;
   return $result; 
  }


  function total_completed_services(){
    // DB::enableQueryLog();
   $result  = DB::table('users')->where('type',3)->count('id');
   // dd(DB::getQueryLog());die;
   return $result; 
}

function total_cancelled_services(){
    // DB::enableQueryLog();
   $result  = DB::table('users')->where('type',3)->count('id');
   // dd(DB::getQueryLog());die;
   return $result; 
}





    
    // function daily_product_sold(){
    //   $result = DB::table('order_details')->whereIn('order_id', function($query){
    //                     $query->select('order_id')
    //                     ->from('orders')
    //                     ->where('created_at', '>=', Carbon::now()->toDateString())
    //                     ->whereIn('status',[1,2,3,4,5]);
    //                 })->count('id');
    //     return $result;            
    // }
    
    // function weekly_product_sold(){
    //   $result = DB::table('order_details')->whereIn('order_id', function($query){
    //                     $query->select('order_id')
    //                     ->from('orders')
    //                     ->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())
    //                     ->whereIn('status',[1,2,3,4,5]);
    //                 })->count('id');
    //     return $result;            
    // }
    
    // function monthly_product_sold(){
    //   $result = DB::table('order_details')->whereIn('order_id', function($query){
    //                     $query->select('order_id')
    //                     ->from('orders')
    //                     ->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
    //                     ->whereIn('status',[1,2,3,4,5]);
    //                 })->count('id');
    //     return $result;            
    // }
    
    // function yearly_product_sold(){
    //   $result = DB::table('order_details')->whereIn('order_id', function($query){
    //                     $query->select('order_id')
    //                     ->from('orders')
    //                     ->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())
    //                     ->whereIn('status',[1,2,3,4,5]);
    //                 })->count('id');
    //     return $result;            
    // }
    
    // function total_product_sold(){
    //   $result = DB::table('order_details')->whereIn('order_id', function($query){
    //                     $query->select('order_id')
    //                     ->from('orders')
    //                     ->whereIn('status',[1,2,3,4,5]);
    //                 })->count('id');
    //     return $result;            
    // }
    
    
    // function daily_payment(){
    //   $result = DB::table('orders')->where('status',5)->where('payment_status',"1")->where('updated_at', '>=', Carbon::now()->toDateString())->sum('final_amount');
    //     return $result;  
    // }
    // function weekly_payment(){
    //     $result = DB::table('orders')->where('status',5)->where('payment_status',"1")->where('updated_at', '>=', Carbon::now()->startOfWeek()->toDateString())->sum('final_amount');
    //     return $result; 
    // }
    // function monthly_payment(){
    //   $result = DB::table('orders')->where('status',5)->where('payment_status',"1")->where('updated_at', '>=', Carbon::now()->startOfMonth()->toDateString())->sum('final_amount');
    //     return $result;    
    // }
    // function yearly_payment(){
    //     $result = DB::table('orders')->where('status',5)->where('payment_status',"1")->where('updated_at', '>=',Carbon::now()->startOfYear()->toDateString())->sum('final_amount');
    //     return $result; 
    // }
    // function total_payment(){
    //     $result = DB::table('orders')->where('status',5)->where('payment_status',"1")->sum('final_amount');
    //     return $result; 
    // }
    
}
