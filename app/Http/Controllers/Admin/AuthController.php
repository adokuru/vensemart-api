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
use Cache;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'email'      => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password'   =>'required',
            ],

            [
                'email.required'    => 'Please enter email.',
                
                'password.required'    => 'Please enter password.',
            ]
        );

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($validator)->withInput();
         }else 
            {
                $cred['email'] = $request->email;
                $cred['password'] = $request->password;
                
                $userData = Admin::where('email', $request->email)->first();
               
                if($userData == null){
                    return redirect()->back()->withErrors('Email is not registered with us')->withInput();
                } 
                if(!(Hash::check(request('password'), $userData->password))){
                    return redirect()->back()->withErrors('Your password is incorrect')->withInput();
                }
                if (Auth::attempt($cred))
                {
                    // if((Auth::user()->role == Config::get('constants.roles.Admin')))
                    // {
                        return redirect('admin/dashboard');
                    // }
                    // else
                    // {
                    //     \Auth::logout();
                    //   return redirect()->back()->withErrors('Invalid crediantials');
                    // }
                }
                else
                {
                    return redirect()->back()->withErrors('Invalid crediantials');
                }

            }
        }
        
        if(auth()->user()){
            return redirect('admin/dashboard');
        }
        return view('login');
    }


    /*******************profile update password**********************/
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['required','same:new_password'],
        ]);
        
        if ($validator->fails())
        { 
            $messages = $validator->messages();
            foreach ($messages->all() as $message)
            {

            }
            // return response()->json(['status' => 400,'message'=>$validator->errors()->all()]);
            $request->session()->flash('error_ee', 'old password is not correct please try again!');
        }
        
        Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return response()->json(['status' => 200, 'message'=>'Password change successfully.']);
        
       
    }

    /*******************profile**********************/
    /*******************profile**********************/
    public function profile(Request $request){
        
        if($request->isMethod('post')){
            $input = $request->all();
            // print_r($input);die;
            $request->validate([
                'full_name' => 'required',
                'email' => 'required',
                'mobile_no' => 'required',
            ]);
            
            if($input['id'] == auth()->user()->id){
                $profileImage = $request->old_profile;
                if(!empty($request->profile_image)){
                    $imageName = time().'.'.$request->profile_image->extension();
                    // $request->profile_image->move('/uploads/profile/', $imageName);
                    $request->file('profile_image')->move('uploads/profile', $imageName);
                    // if(!empty($request->old_profile)){
                    //     $image_path = url('/uploads/profile/').'/'.$request->old_profile;
                    //     unlink($image_path);
                    // }
                    $profileImage = $imageName;
                }
                
                $user = Admin::find($input['id']);
                $user->username = $input['full_name'];
                $user->mobile_no = $input['mobile_no'];
                $user->profile_image = $profileImage;
                
                $user->save();
                return redirect('admin/profile')->with('success', 'Profile updated successfully.');

            }else{
                return redirect()->back()->with('error', 'Something went wrong!');
            }
            
        }
        
        $data['profile'] = Admin::where('id',auth()->user()->id)->first();
        
        return view('profile', $data);
    }
    public function editProfile(Request $request)
    {
        if($request->isMethod('post')){
            
            $input = $request->all();
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
            ]);
            
            if($input['id'] == auth()->user()->id){
                $profileImage = $request->old_profile;
                if(!empty($request->profile)){
                    $imageName = time().'.'.$request->profile->extension();
                    $request->profile->move(public_path('/file/admin/profile/'), $imageName);
                    if(!empty($request->old_profile)){
                        $image_path = public_path().'/file/admin/profile/'.$request->old_profile;
                        unlink($image_path);
                    }
                    $profileImage = $imageName;
                }
                
                $user = Admin::find($input['id']);
                $user->username = $input['name'];
                $user->mobile_no = $input['mobile'];
                $user->profile = $profileImage;
                
                $user->save();
                return redirect('admin/view-profile')->with('success', 'Profile updated successfully.');

            }else{
                return redirect()->back()->with('error', 'Something went wrong!');
            }
            
        }
        $profile = Admin::where('id',auth()->user()->id)->first();
        return view('admin.profile.edit_profile', compact('profile'));
    }


     /***************************Change Password*****************/

    public function change_password(Request $request)
    {
        $id = Auth::user()->id;
        
        $re  = Admin::find($id);

        $request->validate([
        'old_password' => 'required',
        'password' => 'required|same:password_confirmation|min:6',
        'password_confirmation' => 'required',
         ]);
       if (!Hash::check($request->old_password, $re->password)) {
            $request->session()->flash('error_ee', 'old password is not correct please try again!');
            return redirect('admin/profile');
       }
      $re->password = Hash::make($request->password);
      $result = $re->save();
       if($result){
              $request->session()->flash('success', 'Password change Successfully!');
            //   Auth::logout();
            return redirect('admin/profile');
            }else{
                 $request->session()->flash('error_ee', 'Error to change password!');
                return redirect('admin/profile');
            }
    }
    /********************Logout *************************/
    public function logout(Request $request)
    {
        if(auth()->user()->role == Config('constants.roles.Admin')){
            Auth::logout();
            Session::flush();
            Cache::flush();
            return redirect('admin/login');
        }
        else{
            Auth::logout();
            Session::flush();
            Cache::flush();
            return redirect('admin/login');
        }
        
    }
}