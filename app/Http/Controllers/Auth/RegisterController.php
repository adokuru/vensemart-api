<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\PocRegistration;
use App\Models\Stores;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dupp';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

       

       $random = rand(200000, 900000);

        Stores::create([
            'address' => 'Abuja', 
            'franchise_id'=> 'WH'.$random,
            'lati'=> '9.0659989', 
            'longi'=> '7.4239171', 
            'status' => '1',
             'store_image' => 'No Store Image',
             'store_name' => 'No Store Name', 
        ]);


        //$store =  Store::where(franchise_id, Auth->user_id)->first();
        // Products::where('shop_id', $store->id)->get();

        // Products::create([

        //     'shop_id' => $store->id,
        //      'cat_id'=> $cat-id,
        // ])

        return PocRegistration::create([
            'name' => $data['name'],
            'first_name' => $data['name'],
            'last_name' => $data['name'],
            'address' => 'Abuja',
            'city' => 'Abuja',
            'state' => 'FCT',
            'country' => 'Nigeria',
            'telephone' => $data['phone_no'],
            'email' => $data['email'],
            'username' => $data['name'],
            'user_id' => 'WH'.$random,
            'ref_id' => 1000,
            'lendmark' => 'Abuja',
             'zipcode'  => '100101',
             'admin_status'=> 1,
             'user_status' => 'Abuja',
             'registration_date'=> now(),
            'image'=> 'No image',
            'acc_name'=> 'Abuja',
            'ac_no'=> '00000000',
            'bank_nm'=> 'Access',
            'branch_nm'=> 'Main Branch',
            'swift_code'=> 'Enter Swift code',
            'last_login_date'=> now(),
            'current_login_date'=> now(),
            'id_card'=> 'NO ID CARD',
            'id_no'=> 'No ID No',
            'kyc_status'=> 1,
            'activation_date'=> now(),
            'franchise_category'=> 'Abuja',
            'franchise_satus'=> 1,
            'is_verified'=> 1,
            'gst'=> 'Abuja',
            'lati'=> '9.0659989', 
            'longi'=> '7.4239171', 
            'merried_status'=> 'Single',
            'gender'=> 'Enter Gender',
            'password' => Hash::make($data['password']),
        ]);
      

    //     $state = State::pluck('country_id');
    // $country = DB::table('country') //table set
    //    ->whereIn('column_name',$state) //if array then used whereIn method
    //    ->where('column_name',$id) //if single value use where method
    //    ->exists();         

    // if($country)
    // {
    //     //
    // }
    // else{
    //     //
    // }

        
       
    }
}
