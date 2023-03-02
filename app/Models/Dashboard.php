<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Dashboard extends Model
{
    use HasFactory;
    
    public function get_total_daily_existing_user(){

        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_weekly_existing_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
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
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_new_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "1")->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
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
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_monthly_existing_service_user(){
        
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())->count('id');
        // dd(DB::getQueryLog());die;
        return $result;
    }
    public function get_total_yearly_existing_service_user(){
       
        // DB::enableQueryLog();
        $result  = DB::table('users')->where('type', "3")->where('created_at', '>=', Carbon::now()->startOfYear()->toDateString())->count('id');
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
