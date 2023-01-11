<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Traits\SendMessage;


use Mail;

use App\Mail\NotifyMail;
use App\Models\UserVerifiedInfo;

class AuthController extends Controller
{
    use SendMessage;

    public function test()
    {
        print_r("test");
    }

    // Send OTP

    public function send_otp(Request $request)
    {
        try {
            $typevalidate = Validator::make($request->all(), [
                'phone_number' => 'required'
            ]);

            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }

            $users = User::where(function ($query) use ($request) {
                $query->orwhere('mobile', $request->phone_number);
            })->first();

            if (!$users) {
                $arr['status'] = 0;
                $arr['message'] = 'Phone number not found';
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }

            // set otp

            $otp = rand(1000, 9999);
            $users->otp = $otp;
            $users->save();



            $phone_Number = '+234' . substr($request->phone_number, -10);
            $message = "Your Vensemart authentication code is " . $otp . ". Please do not share this code with anyone. This code expires in 5 mins.";

            $this->sendSMSMessage($phone_Number, $message);

            $arr['status'] = 1;
            $arr['message'] = 'OTP sent successfully';
            $arr['data'] = NULL;
            return response()->json($arr, 200);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }

    public function forgot_password(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'phone_number' => 'required',
            'code' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);


        if ($typevalidate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $typevalidate->errors()->first();
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        $users = User::where(function ($query) use ($request) {
            $query->orwhere('mobile', $request->phone_number);
        })->first();

        if (!$users) {
            $arr['status'] = 0;
            $arr['message'] = 'Phone number not found';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }


        if ($users->otp != $request->code) {
            $arr['status'] = 0;
            $arr['message'] = 'Invalid OTP';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        if ($users->password == Hash::make($request->password)) {
            $arr['status'] = 0;
            $arr['message'] = 'New password cannot be the same as old password';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        if ($request->password != $request->confirm_password) {
            $arr['status'] = 0;
            $arr['message'] = 'Password and confirm password does not match';
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        }

        $users->password = Hash::make($request->password);

        $users->save();

        $arr['status'] = 1;
        $arr['message'] = 'Password changed successfully';
        $arr['data'] = NULL;
        return response()->json($arr, 200);
    }


    public function verify_otp(Request $request)
    {
        try {
            $typevalidate = Validator::make($request->all(), [
                'phone_number' => 'required',
                'otp' => 'required'
            ]);

            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }

            $users = User::where(function ($query) use ($request) {
                $query->orwhere('mobile', $request->phone_number);
            })->first();

            if (!$users) {
                $arr['status'] = 0;
                $arr['message'] = 'Phone number not found';
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }


            if ($users->otp != $request->otp) {
                $arr['status'] = 0;
                $arr['message'] = 'Invalid OTP';
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }


            $data = $this->DojahVerifyNumber($request->phone_number);

            if (array_key_exists('error', $data)) {
                $arr['status'] = 0;
                $arr['message'] = $data['error'];
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }

            UserVerifiedInfo::create([
                'user_id' => $users->id,
                'data' => json_encode($data['entity'])
            ]);

            // get user first name from name
            $parts = explode(' ', $users->name);
            if (count($parts) > 2) {
                $first_name = $parts[0];
                $middle = $parts[1] ?? '';
                $last_name = $parts[2] ?? '';
            } else {
                $first_name = $parts[0];
                $middle = "";
                $last_name = $parts[1] ?? "";
            }
            if ($first_name == $data['entity']['firstname'] || $first_name == $data['entity']['lastname']) {
                $users->otp = NULL;
                $users->is_phone_verified = 1;
                $users->save();
                $arr['status'] = 1;
                $arr['message'] = 'OTP verified successfully';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            if ($middle == $data['entity']['firstname'] || $middle == $data['entity']['lastname']) {
                $users->otp = NULL;
                $users->is_phone_verified = 1;
                $users->save();
                $arr['status'] = 1;
                $arr['message'] = 'OTP verified successfully';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            if ($last_name == $data['entity']['firstname'] || $last_name == $data['entity']['lastname']) {
                $users->otp = NULL;
                $users->is_phone_verified = 1;
                $users->save();
                $arr['status'] = 1;
                $arr['message'] = 'OTP verified successfully';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $arr['status'] = 0;
            $arr['message'] = "Name does not match with phone number owner's name";
            $arr['data'] = NULL;
            return response()->json($arr, 422);
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }

    //Registration API
    public function register(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'type' => 'required',
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'state' => 'required',
            'town' => 'required'

        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $users = User::where(function ($query) use ($request) {
                $query->where('email', $request->email);
                $query->orwhere('mobile', $request->mobile);
            })
                ->first();
            if ($users) {
                $arr['status'] = 0;
                $arr['message'] = 'E-mail id or Phone number already exist!!';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $data = $request->all();
            $data['location'] = "Wuse 2 Abuja";
            $data['location_lat'] = "9.0787";
            $data['location_long'] = "7.47018";

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            DB::beginTransaction();
            try {
                $user = User::create($data);
                $token = $user->createToken('Pontus')->accessToken;
                User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token]);
                $userArr = User::where('id', $user->id)->get()->first();
                DB::commit();
                if ($user) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $userArr;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Try Again';
                    $arr['data'] = NULL;
                }
            } catch (\Exception $e) {
                DB::rollback();
                $arr['status'] = 0;
                $arr['message'] = 'something went wrong';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "Something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }




    public function service_pro_register(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',

        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $users = User::where(function ($query) use ($request) {
                $query->where('email', $request->email);
                $query->orwhere('mobile', $request->mobile);
            })
                ->first();
            if ($users) {
                $arr['status'] = 0;
                $arr['message'] = 'E-mail id or Phone number already exist!!';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }

            if (!empty($request->id_prof)) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('id_prof')->getClientOriginalName();
                $store = $request->file('id_prof')->move('uploads/id_prof', $file_name);
                if ($store) {
                    $data['id_prof'] = $file_name;
                }
            }


            if (!empty($request->profile)) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('profile')->getClientOriginalName();
                $store = $request->file('profile')->move('uploads/profile', $file_name);
                if ($store) {
                    $data['profile'] = $file_name;
                }
            }

            $data['type'] = 3;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['device_id'] = $request->device_id;
            $data['device_type'] = $request->device_type;
            $data['device_name'] = $request->device_name;
            $data['device_token'] = $request->device_token;
            $data['password'] = Hash::make($request->password);
            $data['location'] = "Wuse 2 Abuja";
            $data['location_lat'] = "9.0787";
            $data['location_long'] = "7.47018";


            $user = User::create($data);
            $token = $user->createToken('Pontus')->accessToken;
            User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token]);
            $userArr = User::where('id', $user->id)->first();
            DB::commit();
            if ($user) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $userArr;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    //Login API
    public function login(Request $request)
    {
        $typevalidate = Validator::make($request->all(), [
            'type' => 'required',
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->username);
                $query->orwhere('mobile', $request->username);
            })
                ->where('type', $request->type)
                ->first();

            if (!empty($user)) {
                if (!Hash::check($request->password, $user->password)) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Password is not matched';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
                $data['type'] = $request->type;
                $data['device_id'] = $request->device_id;
                $data['device_type'] = $request->device_type;
                $data['device_name'] = $request->device_name;
                $data['device_token'] = $request->device_token;
                if (strpos($request->username, '@')) {
                    $data['email'] = $request->username;
                } else {
                    $data['mobile'] = $request->username;
                }
                // print_r($user);die;
                $token = $user->createToken('Pontus')->accessToken;
                User::where('id', $user->id)->update(['remember_token' => $token, 'api_token' => $token, 'device_id' => $request->device_id, 'device_type' => $request->device_type, 'device_name' => $request->device_name, 'device_token' => $request->device_token]);
                $userArr = User::where('id', $user->id)->get()->first();
                if ($user) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $userArr;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'No user found';
                    $arr['data'] = NULL;
                }
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No user found';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "Something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }



    public function service_pro_login(Request $request)
    {

        $typevalidate = Validator::make($request->all(), [
            'device_id' => 'required',
            'device_type' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);
        try {
            if ($typevalidate->fails()) {
                $arr['status'] = 0;
                $arr['message'] = $typevalidate->errors()->first();
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->username);
                $query->orwhere('mobile', $request->username);
            })
                ->where('type', 3)
                ->first();

            if (!empty($user)) {
                if (!Hash::check($request->password, $user->password)) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Password is not matched';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
                $data['type'] = $request->type;
                $data['device_id'] = $request->device_id;
                $data['device_type'] = $request->device_type;
                $data['device_name'] = $request->device_name;
                $data['device_token'] = $request->device_token;
                $data['location_lat'] = $request->latitude;
                $data['location_long'] = $request->longitude;
                $data['type'] = 3;
                // $data['password'] = Hash::make($request->password);
                if (strpos($request->username, '@')) {
                    $data['email'] = $request->username;
                } else {
                    $data['mobile'] = $request->username;
                }
                // print_r($user);die;
                $token = $user->createToken('Pontus')->accessToken;
                $data['remember_token'] = $token;
                $data['api_token'] = $token;
                User::where('id', $user->id)->update($data);
                $userArr = User::select('*', DB::raw('CONCAT("' . url('uploads/id_prof') . '","/",id_prof)  as id_prof'), DB::raw('CONCAT("' . url('uploads/profile') . '","/",profile)  as profile'))->where('id', $user->id)->get()->first();
                if ($user) {
                    // plan is exit or not 
                    $get_active_plan = DB::table("service_plan_purchase")->where("status", "1")->where("service_provider_id", $user->id)->first();
                    if ($get_active_plan) {
                        $userArr->is_plan_active = 1;
                    } else {
                        $userArr->is_plan_active = 0;
                    }

                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $userArr;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'No user found';
                    $arr['data'] = NULL;
                }

                // $arr['status']=0;
                // $arr['message']="Sorry!! You Cannot Login";
                // $arr['data']=NULL;

                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No user found';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = "Something went wrong";
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }




    /******************Change password*******************************/



    function test11()
    {


        $getServiceProvider =  DB::table('users')->select('id', 'email', 'name')->where('id', 71)->first();
        //return $getServiceProvider;
        if ($getServiceProvider) {
            $bookingId  = "23424242";
            $data['name'] = $getServiceProvider->name;
            $data['msg'] = "New Service Recieved : your have received new  service successfully, Booking id is " . $bookingId;
            $data['subject'] = "Service Recieved";
            \Mail::to($getServiceProvider->email)->send(new \App\Mail\SendOrderMail($data));
            if (Mail::failures()) {

                return new Error(Mail::failures());
            }
        }



        die;
        $data['otp'] = "1234";

        \Mail::to('duversh@maxtratechnologies.net')->send(new \App\Mail\SendOtpMail($data));
        if (Mail::failures()) {

            return new Error(Mail::failures());
        }
        /*
            $otp = rand(1111,9999);
            $msg = "OTP is - " . $otp;
  
        
           
            
            $username = "ejikeme.evuolu@gmail.com";
            $password = "Chukwuemeka";
            $sender = "+2347031053693";
            $ch = curl_init();
            $mobiles = "1";
            $url = "https://www.bbnplace.com/sms/bulksms/bulksms.php?username=" . $username . "&password=" . $password . "&sender=". $sender ."&message=" . $msg."&mobile=".$mobiles;
            curl_setopt($ch, CURLOPT_URL, $url);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, fasle);
        
            $output = curl_exec($ch);
            
            echo json_encode($output);
            curl_close($ch);*/
    }



    public function send_recover_password_otp(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'username' => 'required',
            ]);

            $user_details = User::where('email', $request->username)->orwhere('mobile', $request->username)->first();
            if (!$user_details) {
                $arr['status'] = 0;
                $arr['message'] = 'Username Not Exist.';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $otp = rand(1111, 9999);
            $data = array(
                'username' => $request['username'],
                'otp' => $otp
            );
            $upd['otp'] = $otp;
            User::where('id', $user_details->id)->update($upd);
            $msg = "Dear Applicant, your OTP for vensemart app forgot password is " . $otp . ". Please do not share it with other.";
            if (is_numeric($request->username)) {
                $m_number = "234" . $request->username;
                $this->send_otp($m_number, $msg);
            }

            $sent = true;
            if (strpos($request->username, '@')) {
                $data['email'] = $request->username;
                $data['title1'] = "Dear Applicant";
                $data['msg'] = "your OTP for vensemart app forgot password is " . $otp . ". Please do not share it with other.";
                $data['subject'] = "Otp Received";

                \Mail::to($request->username)->send(new \App\Mail\SendOtpMail($data));
                //$sent = true;
            }
            if (!$sent) {
                $arr['status'] = 0;
                $arr['message'] = 'unable to sent otp.';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }


            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $otp;

            return response()->json($arr, 200);
        } catch (Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong.';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
    }




    public function service_send_otp(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'username' => 'required',
            ]);

            $user_exit = User::where('email', $request->username)->orwhere('mobile', $request->username)->first();

            if (empty($user_exit)) {
                $arr['status'] = 0;
                $arr['message'] = 'username not valid..';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            }
            $otp = rand(1111, 9999);
            $msg = "Dear Applicant, your OTP for vensemart app is " . $otp . ". Please do not share it with other.";
            if (is_numeric($request->username)) {
                $m_number = "234" . $request->username;
                $this->send_otp($m_number, $msg);
            }

            $data = array(
                'username' => $request['username'],
                'otp' => $otp
            );
            $user_details = User::where('email', $request->username)->orwhere('mobile', $request->username)->first();
            if ($user_details) {
                $upd['otp'] = $otp;
                User::where('id', $user_details->id)->update($upd);
            }
            $sent = true;
            if (strpos($request->username, '@')) {
                $data['email'] = $request->username;
                $data['title1'] = "Dear Applicant";
                $data['msg'] = "your OTP for vensemart app is " . $otp . ". Please do not share it with other.";
                $data['subject'] = "Otp Received";

                \Mail::to($request->username)->send(new \App\Mail\SendOtpMail($data));
                //$sent = true;
            }
            if (!$sent) {
                $arr['status'] = 0;
                $arr['message'] = 'unable to sent otp.';
                $arr['data'] = NULL;

                return response()->json($arr, 200);
            }


            $arr['status'] = 1;
            $arr['message'] = 'Success';
            $arr['data'] = $otp;

            return response()->json($arr, 200);
        } catch (Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong.';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }
    }




    /********************************************************/
    /***************verify password otp*********************/
    public function verify_recover_password_otp(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'username' => 'required',
                'otp' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'validation fails.',
                    'data' => NULL
                ), 200);
            }

            $userArr = User::where(function ($where) use ($request) {
                $where->where('mobile', $request['username'])
                    ->orWhere('email', $request['username']);
            })
                ->where('otp', $request['otp'])
                ->get()->first();

            if (empty($userArr)) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'Invalid username/otp.',
                    'data' => NULL
                ), 200);
            }

            User::where('id', $userArr->id)->update(['otp' => NULL]);

            $data = array('username' => $request['username']);

            return response()->json(array(
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            ), 200);
        } catch (Exception $e) {
            return response()->json(array(
                'status' => 0,
                'message' => 'something went wrong.',
                'data' => NULL
            ), 200);
        }
    }


    public function verify_account_otp(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'username' => 'required',
                'otp' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'validation fails.',
                    'data' => NULL
                ), 200);
            }

            $userArr = User::where(function ($where) use ($request) {
                $where->where('mobile', $request['username'])
                    ->orWhere('email', $request['username']);
            })
                ->where('otp', $request['otp'])
                ->get()->first();

            if (empty($userArr)) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'Invalid username/otp.',
                    'data' => NULL
                ), 200);
            }

            User::where('id', $userArr->id)->update(['otp' => NULL]);

            $data = array('username' => $request['username']);

            return response()->json(array(
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            ), 200);
        } catch (Exception $e) {
            return response()->json(array(
                'status' => 0,
                'message' => 'something went wrong.',
                'data' => NULL
            ), 200);
        }
    }


    /*******************************************************/
    /***************update password ************************/

    public function update_password(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'validation fails.',
                    'data' => NULL
                ), 200);
            }

            $userArr = User::where(function ($where) use ($request) {
                $where->where('mobile', $request['username'])
                    ->orWhere('email', $request['username']);
            })
                ->get()->first();

            if (empty($userArr)) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'Invalid username.',
                    'data' => NULL
                ), 200);
            }

            $password = Hash::make($request['password']);

            $update = User::where('id', $userArr->id)->update(['password' => $password]);

            if ($update == 1) {
                return response()->json(array(
                    'status' => 1,
                    'message' => 'password changed successfully.',
                    'data' => NULL
                ), 200);
            }

            return response()->json(array(
                'status' => 0,
                'message' => 'unable to change password.',
                'data' => NULL
            ), 200);
        } catch (Exception $e) {
            return response()->json(array(
                'status' => 0,
                'message' => 'something went wrong.',
                'data' => NULL
            ), 200);
        }
    }


    public function forget_password(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'validation fails.',
                    'data' => NULL
                ), 200);
            }

            $userArr = User::where(function ($where) use ($request) {
                $where->where('mobile', $request['username'])
                    ->orWhere('email', $request['username']);
            })
                ->get()->first();

            if (empty($userArr)) {
                return response()->json(array(
                    'status' => 0,
                    'message' => 'Invalid username.',
                    'data' => NULL
                ), 200);
            }

            $password = Hash::make($request['password']);

            $update = User::where('id', $userArr->id)->update(['password' => $password]);

            if ($update == 1) {
                return response()->json(array(
                    'status' => 1,
                    'message' => 'password changed successfully.',
                    'data' => NULL
                ), 200);
            }

            return response()->json(array(
                'status' => 0,
                'message' => 'unable to change password.',
                'data' => NULL
            ), 200);
        } catch (Exception $e) {
            return response()->json(array(
                'status' => 0,
                'message' => 'something went wrong.',
                'data' => NULL
            ), 200);
        }
    }


    /******************profile update**********************************/

    public function update_profile(Request $request)
    {
        $validate = Validator::make($request->all(), ['name' => 'required']);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 200);
        }

        try {
            $insert = $request->all();

            if (!empty($request->profile)) {
                $file_name = date('dmy') . rand(1, 4) . $request->file('profile')->getClientOriginalName();
                $store = $request->file('profile')->move('uploads/profile', $file_name);
                if ($store) {
                    $insert['profile'] = $file_name;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Profile image not uploaded!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            if (!empty($request->email)) {
                $email = User::where('id', '!=', Auth::id())->where('email', $request->email)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Email already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            if (!empty($request->mobile)) {
                $email = User::where('id', '!=', Auth::id())->where('mobile', $request->mobile)->count();
                if ($email >= 1) {
                    $arr['status'] = 0;
                    $arr['message'] = 'Mobile already exist.!!';
                    $arr['data'] = NULL;

                    return response()->json($arr, 200);
                }
            }
            $user = User::where('id', Auth::id())->update($insert);

            if ($user) {
                $userdata = User::where('id', Auth::id())->first();
                $userdata->profile = !empty($userdata->profile) ? url('uploads/profile') . '/' . $userdata->profile : '';
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data']['user'] = $userdata;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = $e->getMessage();
            $arr['data'] = NULL;
        }

        return response()->json($arr, 200);
    }
    /***************************user profile*************************/
    public function user_details()
    {
        $arr = [];

        try {
            $id = Auth::id();
            // print_r(Auth::id());die;
            $profile = Auth::user();

            if ($profile->type == "2") {
                $vehicledetails = DB::table('vehicle_details')->where('user_id', $profile->id)->first();
                $profile->vehicledetails = $vehicledetails;
                if ($profile) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $profile;
                }
            }
            if ($profile->type == "1") {
                $profile->profile = $profile->profile ? url('uploads/profile') . '/' . $profile->profile : '';

                if ($profile) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = $profile;
                }
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Something went wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    /******************change update**********************************/

    public function change_password(Request $request)
    {
        $arr = [];

        $validate = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required'
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = 'Validation failed';
            $arr['data'] = NULL;

            return response()->json($arr, 422);
        }

        try {

            $user = User::where('id', Auth::id())->value('password');
            # code...


            if (Hash::check($request->password, $user)) {
                $update = User::where('id', Auth::id())->update(['password' => Hash::make($request->new_password)]);

                if ($update) {
                    $arr['status'] = 1;
                    $arr['message'] = 'Success';
                    $arr['data'] = NULL;
                } else {
                    $arr['status'] = 0;
                    $arr['message'] = 'Try Again';
                    $arr['data'] = NULL;
                    return response()->json($arr, 422);
                }
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Invalid old password';
                $arr['data'] = NULL;
                return response()->json($arr, 422);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
        return response()->json($arr, 500);
    }

    public function get_location()
    {
        try {
            $user = User::where('id', Auth::id())->first(['location_lat', 'location', 'location_long']);
            if ($user) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $user;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'User not found';
                $arr['data'] = NULL;
                return response()->json($arr, 404);
            }
        } catch (\Exception $e) {

            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;

            return response()->json($arr, 500);
        }
    }

    public function update_location(Request $request)
    {
        $arr = [];

        $validate = Validator::make($request->all(), [
            'location' => 'required',
            'location_lat' => 'required',
            'location_long' => 'required'
        ]);

        if ($validate->fails()) {
            $arr['status'] = 0;
            $arr['message'] = $validate->errors()->first();
            $arr['data'] = NULL;

            return response()->json($arr, 422);
        }

        try {
            $user = User::where('id', Auth::id())->update($request->all());
            if ($user) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = NULL;
                return response()->json($arr, 200);
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'Try Again';
                $arr['data'] = NULL;
                return response()->json($arr, 404);
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'something went wrong';
            $arr['data'] = NULL;
            return response()->json($arr, 500);
        }
    }
}