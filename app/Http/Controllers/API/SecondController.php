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
}
