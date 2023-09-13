<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Agent\Facades\Agent;

class SecondController extends Controller
{
    public function aboutus()
    {
        try {
            $data = DB::table('aboutus')->first();
            if (!empty($data)) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data Found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }
    public function contactus()
    {
        try {
            $data = DB::table('contact_us')->first();
            if (!empty($data)) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    public function faqs()
    {
        try {
            $data = DB::table('faqs')->get()->toArray();
            if (!empty($data)) {
                $arr['status'] = 1;
                $arr['message'] = 'Success';
                $arr['data'] = $data;
            } else {
                $arr['status'] = 0;
                $arr['message'] = 'No Data found';
                $arr['data'] = NULL;
            }
        } catch (\Exception $e) {
            $arr['status'] = 0;
            $arr['message'] = 'Sorry!! Something Went Wrong';
            $arr['data'] = NULL;
        }
        return response()->json($arr, 200);
    }


    public function detectDeviceAgent(Request $request)
    {
    $referralCode = $request->query('ref');

    // Use the extracted referral code for further processing
    // For example, you can append it to the store link

    $referralLink = 'https://api.vensemart.com/api/ref?';

    if (Agent::isMobile()) {
        // Redirect to iOS store with referral code
        $storeLink = 'https://apps.apple.com/us/app/vensemart-customer/id1670924558?ref=' . $referralCode;
    } elseif (Agent::isAndroidOS()) {
        // Redirect to Android store with referral code
        $storeLink = 'https://play.google.com/store/apps/details?id=com.vensemart.vensemart&ref=' . $referralCode;
    } else {
        // Redirect to the referral link with referral code
        $storeLink = $referralLink . '=' . $referralCode;
    }

    return redirect($storeLink);
   }
}
