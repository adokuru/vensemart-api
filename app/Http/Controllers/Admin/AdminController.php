<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Auth;
use Carbon;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Session;
use App\Models\Dashboard;
class AdminController extends Controller
{
    public function dashboard()
    {
        $dashboard = new Dashboard();
        $data['get_total_daily_existing_user']         =  $dashboard->get_total_daily_existing_user();
        $data['get_total_weekly_existing_user']        =  $dashboard->get_total_weekly_existing_user();
        $data['get_total_monthly_existing_user']       =  $dashboard->get_total_monthly_existing_user();
        $data['get_total_yearly_existing_user']        =  $dashboard->get_total_yearly_existing_user();

        $data['get_total_daily_new_user']              =  $dashboard->get_total_daily_new_user();
        $data['get_total_weekly_new_user']             =  $dashboard->get_total_weekly_new_user();
        $data['get_total_monthly_new_user']            =  $dashboard->get_total_monthly_new_user();
        $data['get_total_yearly_new_user']             =  $dashboard->get_total_yearly_new_user();
        
        $data['get_total_daily_existing_driver']         =  $dashboard->get_total_daily_existing_driver();
        $data['get_total_weekly_existing_driver']        =  $dashboard->get_total_weekly_existing_driver();
        $data['get_total_monthly_existing_driver']       =  $dashboard->get_total_monthly_existing_driver();
        $data['get_total_yearly_existing_driver']        =  $dashboard->get_total_yearly_existing_driver();

        $data['get_total_daily_new_driver']              =  $dashboard->get_total_daily_new_driver();
        $data['get_total_weekly_new_driver']             =  $dashboard->get_total_weekly_new_driver();
        $data['get_total_monthly_new_driver']            =  $dashboard->get_total_monthly_new_driver();
        $data['get_total_yearly_new_driver']             =  $dashboard->get_total_yearly_new_driver();
        
        $data['ordered_placed_daily']                    =  $dashboard->ordered_placed_daily();
        $data['ordered_placed_weekly']                   =  $dashboard->ordered_placed_weekly();
        $data['ordered_placed_monthly']                  =  $dashboard->ordered_placed_monthly();
        $data['ordered_placed_yearly']                   =  $dashboard->ordered_placed_yearly();
        $data['ordered_placed_total']                    =  $dashboard->ordered_placed_total();
        

        $data['total_daily_new_product']              =  $dashboard->total_daily_new_product();
        $data['total_weekly_new_product']             =  $dashboard->total_weekly_new_product();
        $data['total_monthly_new_product']            =  $dashboard->total_monthly_new_product();
        $data['total_yearly_new_product']             =  $dashboard->total_yearly_new_product();
        $data['total_new_product']                    =  $dashboard->total_new_product();
        
        $data['total_daily_new_product']              =  $dashboard->total_daily_new_product();
        $data['total_weekly_new_product']             =  $dashboard->total_weekly_new_product();
        $data['total_monthly_new_product']            =  $dashboard->total_monthly_new_product();
        $data['total_yearly_new_product']             =  $dashboard->total_yearly_new_product();
        $data['total_new_product']                    =  $dashboard->total_new_product();
        
        $data['total_daily_out_of_stack_product']     =  $dashboard->total_daily_out_of_stack_product();
        $data['total_weekly_out_of_stack_product']    =  $dashboard->total_weekly_out_of_stack_product();
        $data['total_monthly_out_of_stack_product']   =  $dashboard->total_monthly_out_of_stack_product();
        $data['total_yearly_out_of_stack_product']    =  $dashboard->total_yearly_out_of_stack_product();
        $data['total_out_of_stack_product']           =  $dashboard->total_out_of_stack_product();
        
        // $data['daily_product_sold']                   =  $dashboard->daily_product_sold();
        // $data['weekly_product_sold']                  =  $dashboard->weekly_product_sold();
        // $data['monthly_product_sold']                 =  $dashboard->monthly_product_sold();
        // $data['yearly_product_sold']                  =  $dashboard->yearly_product_sold();
        // $data['total_product_sold']                   =  $dashboard->total_product_sold();
        
        // $data['daily_payment']                   =  $dashboard->daily_payment();
        // $data['weekly_payment']                  =  $dashboard->weekly_payment();
        // $data['monthly_payment']                 =  $dashboard->monthly_payment();
        // $data['yearly_payment']                  =  $dashboard->yearly_payment();
        // $data['total_payment']                   =  $dashboard->total_payment();
        
        return view('dashboard',$data);
    }
    public function manageexisting_user(Request $request)
    {
        
            $data['listing']=DB::table('users')->where('type','1')->orderBy('id','desc')->get();
            
            return view('manage.user.exist_user_listing',$data);    
    }
    public function existinguseredit($id)
    {
        $data['user']=DB::table('users')->where('id',$id)->first();
        return view('manage.user.edit',$data);
    }
    public function managenew_user()
    {
        $lastSavenDate = date('Y-m-d H:i:s', strtotime("-7 day", strtotime(date('Y-m-d H:i:s'))));
       
        $data['listing'] = DB::table('users')
                // ->where('is_deleted', '=', 0)
                ->whereBetween('created_at', [$lastSavenDate, date('Y-m-d H:i:s')])
                ->orderBy('id','desc')
                ->orderByRaw('created_at DESC')
                ->get();
        return view('manage.user.new_user_listing',$data);
    }


    public function managenew_existing_user()
    {
        $lastSavenDate = date('Y-m-d H:i:s', strtotime("-7 day", strtotime(date('Y-m-d H:i:s'))));
       
        $data['listing'] = DB::table('users')
                // ->where('is_deleted', '=', 0)
                ->whereBetween('created_at', [$lastSavenDate, date('Y-m-d H:i:s')])
                ->orderBy('id','desc')
                ->orderByRaw('created_at DESC')
                ->get();
        return view('manage.user.new_user_listing',$data);
    }
    
    
    public function vendors_list()
    {
        
        $data['listing'] = DB::table('poc_registration')
                // ->where('is_deleted', '=', 0)
                // ->whereBetween('created_at', [$lastSavenDate, date('Y-m-d H:i:s')])
                ->orderBy('id','desc')
                ->orderByRaw('created_at DESC')
                ->get();
        return view('manage.vendor.listing',$data);
    }
    
    public function edit_vendor($id)
    {
         $user = DB::table('poc_registration')->where('id',$id)->first();
        //  print_r($user);exit;
        return view('manage.vendor.edit', compact('user'));
    }
    
    public function verify_vendor(Request $request)
    {
        
        $result = DB::table('poc_registration')->where('id',$request->edit_id)->update(['is_verified' => $request->verify_status]);
        
        $storedata=DB::table('poc_registration')->where('id',$request->edit_id)->first();
        $storeId=DB::table('stores')->where('franchise_id',$storedata->user_id)->update(['status'=>$request->verify_status]);
        
        ?>
        <script>
                alert('Vendor Status Updated Successfully!!');
                window.location.href="<?php echo url('admin/manage_vendor'); ?>";
            </script>
        <?php
    }
    
    public function managenew_edit(Request $request,$id)
    {
        if($request->method()=="POST")
        {
            $status=$request->status;
            DB::table('users')->where('id',$id)->update(['status'=>$status]);
            ?>
            <script>
                alert('User Updated Successfully!!');
                window.location.href="<?php echo url('admin/managenew_user'); ?>";
            </script>
            <?php
        }
        else
        {
            $data['user']=DB::table('users')->where('id',$id)->first();
            return view('manage.user.edit',$data);
        }
    }
    
    
    
    public function managenew_drivers()
    {
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('vehicle_details.isVerify','2')->where('users.type','2')->get();
      
        return view('manage.driver.listing',$data);
        
    }
    public function viewnew_driver($id)
    {
       
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('users.id',$id)->where('vehicle_details.isVerify','2')->where('users.type','2')->first();
    
        return view('manage.driver.view_driver',$data);
    }
    public function manageexisting_drivers()
    {
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('vehicle_details.isVerify','1')->where('users.type','2')->get();
      
        return view('manage.driver.Exist_listing',$data);
    }
    public function viewexisting_driver($id)
    {
       
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('users.id',$id)->where('vehicle_details.isVerify','1')->where('users.type','2')->first();
    
        return view('manage.driver.view_driver',$data);
    }
    public function new_serviceprovider()
    {
        $data['listing']=DB::table('users')->where('type',3)->where('documents_approved',1)->get();
        
        return view('manage.service_provider.listing',$data);
    }
    public function change_status_of_serviceprovider(Request $request)
    {
        $serviceprovider_id=$request->s_id;
        $serviceprovider_status=$request->is_vaify_val;
        
        DB::table('users')->where('id',$serviceprovider_id)->update(['documents_approved'=>$serviceprovider_status]);
         return response()->json(['status' => 200, 'message'=>'Documents Approved successfully.']);
        
    }
    
    public function exist_serviceprovider()
    {
        $data['listing']= DB::table('users')->where('type',3)->get();
         return view('manage.service_provider.existing_serviceproviderlisting',$data);
    }
    public function viewserviceprovider($id)
    {
      $data['listing']=DB::table('users')->where('id',$id)->first();
        return view('manage.service_provider.view_exist_serviceprovider',$data);
    }
    public function viewserviceprovider_new($id)
    {
        $data['listing']=DB::table('users')->where('id',$id)->first();
        return view('manage.service_provider.view_new_serviceprovider',$data);
    }
    
    public function aboutus_update(Request $request)
    {
        if($request->method()=="POST")
        {
            $description=$request->description;
            DB::table('about_freshmor')->where('id',1)->update(['description'=>$description]);
            ?>
            <script>
                alert('About us Updated Successfully!!');
                window.location.href="<?php echo url('admin/about-us/update'); ?>";
            </script>
            <?php
        }
        else
        {
              $data['about']=DB::table('about_freshmor')->where('id',1)->first();
              return view('manage.contactUS.about-us',$data);
        }
    
    }
    public function contactus_update(Request $request)
    {
        if($request->method()=="POST")
        {
          $email=$request->email;
          $mobile=$request->mobile_no;
          
          DB::table('contact_us')->where('id','1')->update(['email'=>$email,'mobile'=>$mobile]);
          ?>
          <script>
              alert('Contact Us Updated successfully');
              window.location.href="<?php echo url('admin/contactus/update'); ?>";
          </script>
          <?php
        }
        else
        {
            $data['contactus']=DB::table('contact_us')->where('id','1')->first();
            return view('manage.contactUS.contact_us',$data);
        }
    }
    
    public function existinguserdelete($id)
    {
       DB::table('users')->where('id',$id)->delete();
       ?>
       <script>
           alert('User Deleted Successfully!!');
           window.location.href="<?php echo url('admin/manageexisting_user'); ?>";
       </script>
       <?php
    }
    
    public function newuserdelete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        ?>
        <script>
            alert('User Deleted Successfully!!');
            window.location.href="<?php echo url('admin/managenew_user'); ?>";
        </script>
        <?php
    }
    public function addnew_driver(Request $request)
    {
        if($request->method()=="POST")
        {
            // $request->validate($request->all(),['name'=>'required'
              
            
            // ]);
        }
        else
        {
            return view('manage.driver.add');
        }
    }
    
    public function managecategory()
    {
        $data['listing']=DB::table('category')->get();
        
       return view('manage.category.listing',$data);
    }
    public function category_add(Request $request)
    {
        if($request->method()=="POST")
        {
            $validation=$request->validate([$request->all(),'name'=>'required','cetegory_image'=>'required']);
            
            $categoryname=$request->name;
            $status=$request->status;
            
            $img='';
            if(!empty($request->file('cetegory_image')))
            {
                $filename=date('dmy').rand(1,100).$request->file('cetegory_image')->getClientOriginalName();
                $store=$request->file('cetegory_image')->move('storage/app/category_icons',$filename);
                
                $img=$filename;
            }
            
            $data=array('category_name'=>$categoryname,'category_icon'=>$filename,'status'=>1);
            DB::table('category')->insert($data);
            
            ?>
            <script>
                alert('Category Added Successfully!!');
                window.location.href="<?php echo url('admin/managecategory/listing');?>";
            </script>
            <?php
            
        }
        else
        {
            return view('manage.category.add');
        }
    }
    public function categoryedit(Request $request,$id)
    {
        if($request->method()=="POST")
        {
            
            if(!empty($request->file('cetegory_image')))
            {
                $filename=date('dmy').rand(1,100).$request->file('cetegory_image')->getClientOriginalName();
                $store=$request->file('cetegory_image')->move('storage/app/category_icons',$filename);
                $img=$filename;
            }
            else
            {
                $img=$request->old_image;
            }
            $categoryname=$request->name;
             $data=array('category_name'=>$categoryname,'category_icon'=>$img,'status'=>1);
             DB::table('category')->where('id',$id)->update($data);
             ?>
             <script>
                 alert('Category Updated Successfully!!');
                 window.location.href="<?php echo url('admin/managecategory/listing');?>";
             </script>
             <?php
        }
        else
        {
            $data['category']=DB::table('category')->where('id',$id)->first();
            return view('manage.category.edit',$data);
        }
    }
    public function categorydelete($id)
    {
        DB::table('category')->where('id',$id)->delete();
        ?>
        <script>
            alert('Category Deleted Successfully!!');
            window.location.href="<?php echo url('admin/managecategory/listing'); ?>";
        </script>
        <?php
    }
    
    public function managerejected_driverlist()
    {
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('vehicle_details.isVerify',3)->get();
      
       return view('manage.driver.rejected_driver_list',$data);
        
    }
    
    public function change_status_of_rejecteddriver(Request $request)
    {
        $rejecteddriver_id=$request->d_id;
        $rejecteddriver_status=$request->is_vaify_val;
        
        DB::table('vehicle_details')->where('id',$rejecteddriver_id)->update(['isVerify'=>$rejecteddriver_status]);
         return response()->json(['status' => 200, 'message'=>'Documents Approved successfully.']);
    }
    public function rejected_driver_view($id)
    {
        $data['listing']=DB::table('users')->select('users.name','users.email','users.profile','users.mobile','users.id as user_idOne','vehicle_details.*')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('users.id',$id)->where('vehicle_details.isVerify','3')->where('users.type','2')->first();
        return view('manage.driver.rejected_driver_details',$data);
    }
    
    public function rejected_driver_delete($id)
    {
        $vehiclesdetails_data=DB::table('vehicle_details')->where('id',$id)->first();
        DB::table('users')->leftJoin('vehicle_details','vehicle_details.user_id','=','users.id')->where('users.id',$vehiclesdetails_data->user_id)->delete();
        ?>
        <script>
            alert('Rejected Driver Deleted Successfully!!');
            window.location.href="<?php echo url('admin/managerejected_driverlist');?>";
        </script>
        <?php
        
    }
    
   
    
    public function managesubcategory()
    {
        
        $data['listing']=DB::table('category')->select('category.category_name','sub_category.*')->leftJoin('sub_category','sub_category.cat_id','=','category.id')->get();
        
        return view('manage.sub_category.listing',$data);
    }
    public function managesubcategory_add(Request $request)
    {
        if($request->method()=="POST")
        {
            $categoryId=$request->category_id;
            $subcategoryname=$request->sub_cat_name;
            $img='';
            
            if(!empty($request->file('sub_cat_image')))
            {
                $filename=date('dmy').rand(1,1000).$request->file('sub_cat_image')->getClientOriginalName();
                $store=$request->file('sub_cat_image')->move('storage/app/subcategory_images',$filename);
                $img=$filename;
            }
            
            $status=$request->status;
            
            $data=array('cat_id'=>$categoryId,'name'=>$subcategoryname,'image'=>$img,'status'=>$status);
            DB::table('sub_category')->insert($data);
            return redirect('admin/managesubcategory/listing')->with('success','SubCategory Added successfully!');
            
        }
        else
        {
            $data['cat_listing']=DB::table('category')->get();
            return view('manage.sub_category.add',$data);
        }
    }
    public function managesubcategoryedit(Request $request,$id)
    {
        if($request->method()=="POST")
        {
            $categoryId=$request->category_id;
            $subcategory_name=$request->sub_cat_name;
            $status=$request->status;
            
            $img='';
            if(!empty($request->file('sub_cat_image')))
            {
                $filename=date('dmy').rand(1,1000).$request->file('sub_cat_image')->getClientOriginalName();
                $store=$request->file('sub_cat_image')->move('storage/app/subcategory_images',$filename);
                $img=$filename;
            }
            else
            {
                $img=$request->sub_old_image;
            }
            
            $data=array('cat_id'=>$categoryId,'name'=>$subcategory_name,'status'=>$status,'image'=>$img);
            
            DB::table('sub_category')->where('id',$id)->update($data);
            return redirect('admin/managesubcategory/listing')->with('success','SubCategory Updated successfully!');
            
            
        }
        else
        {
            $data['subCat']=DB::table('sub_category')->select('sub_category.*','category.id as categoryId')->leftJoin('category','category.id','=','sub_category.cat_id')->where('sub_category.id',$id)->first();
            $data['cat_listing']=DB::table('category')->get();
            return view('manage.sub_category.edit',$data);
        }
    }
    public function managesubcategorydelete($id)
    {
       DB::table('sub_category')->where('id',$id)->delete();
       return redirect('admin/managesubcategory/listing')->with('success','SubCategory Deleted successfully!');
       
    }
    public function managerejectedservice_providerlist()
    {
        $data['listing']=DB::table('users')->where('type',3)->where('is_phone_verified',3)->get();
        return view('manage.service_provider.rejected_serviceprovider_list',$data);
    }
    
    public function change_status_of_rejectedserviceprovider(Request $request)
    {
        $serviceproviderid=$request->d_id;
        $serviceprovider_status=$request->status_val;
        
        DB::table('users')->where('id',$serviceproviderid)->update(['is_phone_verified'=>$serviceprovider_status]);
         return redirect('admin/managerejectedservice_providerlist')->with('success','Service Provider Approved successfully!');
        
    }
    
    public function managerejectedservice_provider_view($id)
    {
        $data['listing']=DB::table('users')->where('id',$id)->first();
        return view('manage.service_provider.rejected_serviceprovider_view',$data);
    }
    
    public function managerejectedservice_provider_delete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('admin/managerejectedservice_providerlist')->with('success','Service Provider Deleted successfully!');
       
    }
    
    public function managependingorderslisting()
    {
        $data['listing']=DB::table('orders')->select('orders.*','users.name as user_name')->leftJoin('users','users.id','=','orders.user_id')->where('orders.status',1)->orderBy('orders.id','desc')->get();
        
        return view('manage.order.pending_listing',$data);
    }
    public function managependingordersview($id)
    {
        $orders=DB::table('orders')->where('id',$id)->first();
        
        
        $driverDetails=DB::table('users')->where('id',$orders->driver_id)->first();
        
        $ordersdetails=DB::table('eshop_purchase_detail')->select('eshop_purchase_detail.*','uom.name as uom_name')->leftJoin('uom','uom.id','=','eshop_purchase_detail.uom_id')->where('order_id',$orders->order_id)->get();
        $data['order']=$orders;
        $data['order_detail']=$ordersdetails;
        $data['driver_details']=$driverDetails;
        return view('manage.order.view_order',$data);
    }
    public function managependingordersedit(Request $request,$id)
    {
        if($request->method()=="POST")
        {
            $status=$request->order_status;
            DB::table('orders')->where('order_id',$id)->update(['status'=>$status]);
            
            return redirect('admin/order/in-process/listing')->with('success','Order Updated successfully!');
        }
        else
        {
            $data['order_id']=$id;
            return view('manage.order.edit_pendingorder_status',$data);
        }
    }
    
    public function managecompeletedordreslisting()
    {
        $data['listing']=DB::table('orders')->select('users.*','orders.order_id','orders.total_amount','orders.total_item','orders.payment_status')->leftJoin('users','users.id','=','orders.user_id')->where('orders.status',4)->orderBy('orders.id','desc')->get();
        return view('manage.order.completed_listing',$data);
    }
    
    public function managecompletedvieworders($id)
    {
        
        $orders=DB::table('orders')->where('order_id',$id)->first();
        $data['order']=$orders;
        
        $orderdetails=DB::table('eshop_purchase_detail')->select('eshop_purchase_detail.*','uom.name as uom_name','products.product_image as p_image')->leftJoin('products','products.id','=','eshop_purchase_detail.product_id')->leftJoin('uom','uom.id','=','eshop_purchase_detail.uom_id')->where('eshop_purchase_detail.order_id',$orders->order_id)->get();
        $data['order_detail']=$orderdetails;
        
         $data['username']=DB::table('users')->where('id',$data['order']->user_id)->first();
           $data['driverdetails']=DB::table('users')->where('id',$data['order']->driver_id)->first();
        
       return view('manage.order.view_completed_order',$data);
    }
   
   public function managecomplete_editorders(Request $request,$id)
   {
       if($request->method()=="POST")
       {
           $status=$request->order_status;
          DB::table('orders')->where('order_id',$id)->update(['payment_status'=>$status]);
          return redirect('admin/order/completed_orders/listing')->with('success','Order Updated successfully!');
       }
       else
       {
           $data['order']=DB::table('orders')->where('order_id',$id)->first();
           
           $data['order_detail']=DB::table('eshop_purchase_detail')->select('eshop_purchase_detail.*','uom.name as uom_name','products.product_image as p_image')->leftJoin('products','products.id','=','eshop_purchase_detail.product_id')->leftJoin('uom','uom.id','=','eshop_purchase_detail.uom_id')->where('eshop_purchase_detail.order_id',$data['order']->order_id)->get();
           
           $data['username']=DB::table('users')->where('id',$data['order']->user_id)->first();
           $data['driverdetails']=DB::table('users')->where('id',$data['order']->driver_id)->first();
           return view('manage.order.edit_completeorder',$data);
       }
   }
   
   public function termsconditionupdate(Request $request)
   {
       if($request->method()=="POST")
       {
           $description=$request->description;
           DB::table('termsconditions')->where('id',1)->update(['description'=>$description]);
           return redirect('admin/termscondition/update')->with('success','Terms & Condition Updated successfully!');
       }
       else
       {
            $data['termscondition']=DB::table('termsconditions')->first();
             return view('manage.contactUS.termscondition',$data);
       }
      
   }
   public function manageservicecategory_list()
   {
       $data['listing']=DB::table('serviceprovider_category')->get();
       return view('manage.manage_servicecategory.listing',$data);
   }
   
   public function manageservicecategory_add(Request $request)
   {
       if($request->method()=="POST")
       {
           $request->validate([$request->all(),'name'=>'required','cetegory_image'=>'required']);
           
           $categoryname=$request->name;
           $img='';
           if(!empty($request->file('cetegory_image')))
           {
               $filename=date('dmy').rand(1,1000).$request->file('cetegory_image')->getClientOriginalName();
               $store=$request->file('cetegory_image')->move('storage/app/category_icons/',$filename);
               $img=$filename;
           }
           
           $data=array('category_icon'=>$img,'category_name'=>$categoryname);
           DB::table('serviceprovider_category')->insert($data);
           
           return redirect('admin/manageservicecategory_list')->with('success','Service Category Added Successfully!!');
           
       }
       else
       {
           return view('manage.manage_servicecategory.add');
       }
   }
   
   public function manageservicecategory_edit(Request $request,$id)
   {
       if($request->method()=="POST")
       {
           $categoryname=$request->name;
           
           $img='';
           if(!empty($request->file('cetegory_image')))
           {
               $filename=date('dmy').rand(1,1000).$request->file('cetegory_image')->getClientOriginalName();
               $store=$request->file('cetegory_image')->move('storage/app/category_icons/',$filename);
               $img=$filename;
           }
           else
           {
               $img=$request->old_image;
           }
           $data=array('category_name'=>$categoryname,'category_icon'=>$img);
           DB::table('serviceprovider_category')->where('id',$id)->update($data);
           return redirect('admin/manageservicecategory_list')->with('success','Service Category Updated Successfully!!');
       }
       else
       {
           $data['category']=DB::table('serviceprovider_category')->where('id',$id)->first();
           return view('manage.manage_servicecategory.edit',$data);
       }
   }
   public function manageservicecategory_delete($id)
   {
       DB::table('serviceprovider_category')->where('id',$id)->delete();
       return redirect('admin/manageservicecategory_list')->with('success','Service Category Deleted Successfully!!');
   }
   
   public function managewithdrawlrequest_listing()
   {
       $data['listing']=DB::table('request_withdrawn_amounts')->select('request_withdrawn_amounts.*','users.name as user_name','users.mobile as user_mobile','users.email as user_email')->leftJoin('users','users.id','=','request_withdrawn_amounts.driver_id')->where('request_withdrawn_amounts.status',1)->orderBy('request_withdrawn_amounts.id','desc')->get();
       return view('manage.withdrawl_request.listing',$data);
   }
   
   public function managewithdrawlrequest_edit(Request $request,$id)
   {
       if($request->method()=="POST")
       {
           
       }
       else
       {
           $data['order']=DB::table('request_withdrawn_amounts')->select('request_withdrawn_amounts.*','users.name as user_name','users.mobile as user_mobile','users.email as user_email')->leftJoin('users','users.id','=','request_withdrawn_amounts.driver_id')->where('request_withdrawn_amounts.id',$id)->orderBy('request_withdrawn_amounts.id','desc')->first();
           return view('manage.withdrawl_request.edit',$data);
       }
   }
   
   public function countrylisting()
   {
       $data['listing']=DB::table('countries')->orderBy('id','desc')->get();
       return view('manage.country.listing',$data);
   }
   public function countryadd(Request $request)
   {
       if($request->method()=="POST")
       {
           $request->validate([$request->all(),'name'=>'required','code'=>'required','status'=>'required']);
           
           $countryname=$request->name;
           $code=$request->code;
           $status=$request->status;
           
           $data=array('country_code'=>$code,'country_name'=>$countryname,'status'=>$status);
           DB::table('countries')->insert($data);
           
           return redirect('admin/country/listing')->with('success','Country Added Successfully!!');
       }
       else
       {
           return view('manage.country.add');
       }
   }
   public function countryedit(Request $request,$id)
   {
       if($request->method()=="POST")
       {
        //   $request->validate([$request->all(),'name'=>'required','code'=>'required','status'=>'required']);
           
           $countryname=$request->name;
           $code=$request->code;
           $status=$request->status;
           
           $data=array('country_code'=>$code,'country_name'=>$countryname,'status'=>$status);
           DB::table('countries')->where('id',$id)->update($data);
           
           return redirect('admin/country/listing')->with('success','Country Updated Successfully!!');
       }
       else
       {
           $data['countrydata']=DB::table('countries')->where('id',$id)->first();
           return view('manage.country.edit',$data);
       }
   }
   public function countrydelete($id)
   {
       DB::table('countries')->where('id',$id)->delete();
       return redirect('admin/country/listing')->with('success','Country Deleted Successfully!!');
   }
   
   public function statelisting()
   {
       $data['listing']=DB::table('states')->select('states.*','countries.country_name')->leftJoin('countries','countries.id','=','states.country_id')->get();
       return view('manage.state.listing',$data);
   }
   public function stateadd(Request $request)
   {
       if($request->method()=="POST")
       {
           $request->validate([$request->all(),'country'=>'required','name'=>'required','status'=>'required']);
           
           $countryname=$request->country;
           $statename=$request->name;
           $status=$request->status;
           
           $data=array('country_id'=>$countryname,'state_name'=>$statename,'status'=>$status);
           DB::table('states')->insert($data);
           
           return redirect('admin/states/listing')->with('success','States Added Successfully!!');
       }
       else
       {
           return view('manage.state.add');
       }
   }
   public function stateedit(Request $request,$id)
   {
       if($request->method()=="POST")
       {
           $statename=$request->name;
           $status=$request->status;
           
           $data=array('state_name'=>$statename,'status'=>$status);
           DB::table('states')->where('id',$id)->update($data);
           return redirect('admin/states/listing')->with('success','States Updated Successfully!!');
       }
       else
       {
           $data['statedata']=DB::table('states')->where('id',$id)->first();
           return view('manage.state.edit',$data);
       }
   }
   public function statedelete($id)
   {
       DB::table('states')->where('id',$id)->delete();
       return redirect('admin/states/listing')->with('success','State Deleted Successfully');
   }
   
   public function citylisting()
   {
       $data['listing']=DB::table('cities')->select('cities.*','countries.country_name','states.state_name')->leftJoin('countries','countries.id','=','cities.country_id')->leftJoin('states','states.id','=','cities.state_id')->get();
       return view('manage.cities.listing',$data);
   }
   
   public function cityadding(Request $request)
   {
       if($request->method()=="POST")
       {
           
           $request->validate([$request->all(),'country'=>'required','state'=>'required','cityname'=>'required','status'=>'required']);
           
           $country=$request->country;
           $state=$request->state;
           $name=$request->cityname;
           $status=$request->status;
           
           $data=array('country_id'=>$country,'state_id'=>$state,'city_name'=>$name,'status'=>$status);
           DB::table('cities')->insert($data);
           
           return redirect('admin/cities/listing')->with('success','City Added Successfully!!');
           
       }
       else
       {
            return view('manage.cities.add');    
       }
       
   }
   
   public function citydelete($id)
   {
       DB::table('cities')->where('id',$id)->delete();
       return redirect('admin/cities/listing')->with('success','City Deleted Successfully!!');
   }
   
   public function state_list($id)
   {
       $data=DB::table('states')->where('country_id',$id)->get();
       
       echo json_encode($data);
       
   }
   public function citiesedit(Request $request,$id)
   {
       if($request->method()=="POST")
       {
           $cityname=$request->name;
           $status=$request->status;
           
           $data=array('city_name'=>$cityname,'status'=>$status);
           DB::table('cities')->where('id',$id)->update($data);
           return redirect('admin/cities/listing')->with('success','City Updated Successfully!!');
       }
       else
       {
           $data['citiesdata']=DB::table('cities')->where('id',$id)->first();
           return view('manage.cities.edit',$data);
       }
   }




   //manage pending service order 
   public function managependingserviceorderslisting()
    {
        $data['listing']= DB::table('servicebook_user')->select('servicebook_user.*','users.name as user_name')->leftJoin('users','users.id','=','servicebook_user.user_id')->where('servicebook_user.status',1)->orderBy('servicebook_user.id','desc')->get();

   
        // $data['listing']= DB::table('serviceprovider_user_orders')->select('*')->get();
        // dd($data['listing']);

        return view('manage.serviceorder.pending_listing',$data);
    }

    //manage completed service order
 


    public function managecompletedserviceorderslisting()
    {
        $data['listing']= DB::table('servicebook_user')->select('servicebook_user.*','users.name as user_name')->leftJoin('users','users.id','=','servicebook_user.user_id')->where('servicebook_user.status',2)->orderBy('servicebook_user.id','desc')->get();

   
        // $data['listing']= DB::table('serviceprovider_user_orders')->select('*')->get();
        // dd($data['listing']);

        return view('manage.serviceorder.completed_listing',$data);
    }



    public function managecancelledserviceorderslisting()
    {
        $data['listing']= DB::table('servicebook_user')->select('servicebook_user.*','users.name as user_name')->leftJoin('users','users.id','=','servicebook_user.user_id')->where('servicebook_user.status',3)->orderBy('servicebook_user.id','desc')->get();

   
        // $data['listing']= DB::table('serviceprovider_user_orders')->select('*')->get();
        // dd($data['listing']);

        return view('manage.serviceorder.cancelled_listing',$data);
    }


    // public function managependingserviceordersview($id)
    // {
    //     $orders=DB::table('serviceprovider_user_orders')->where('id',$id)->first();
        
        
    //     $driverDetails=DB::table('users')->where('id',$orders->driver_id)->first();
        
    //     $ordersdetails=DB::table('eshop_purchase_detail')->select('eshop_purchase_detail.*','uom.name as uom_name')->leftJoin('uom','uom.id','=','eshop_purchase_detail.uom_id')->where('order_id',$orders->order_id)->get();
    //     $data['order']=$orders;
    //     $data['order_detail']=$ordersdetails;
    //     $data['driver_details']=$driverDetails;
    //     return view('manage.serviceorder.view_order',$data);
    // }

    // public function managependingserviceordersedit(Request $request,$id)
    // {
    //     if($request->method()=="POST")
    //     {
    //         $status=$request->order_status;
    //         DB::table('serviceprovider_user_orders')->where('serviceprovider_user_orders_id',$id)->update(['status'=>$status]);
            
    //         return redirect('admin/serviceorder/in-process/listing')->with('success','Order Updated successfully!');
    //     }
    //     else
    //     {
    //         $data['serviceprovider_user_orders_id']=$id;
    //         return view('manage.serviceorder.edit_pendingorder_status',$data);
    //     }
    // }
 

   
   
   
}
