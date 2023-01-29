<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $newColumn1
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $rating
 * @property int      $role_id
 * @property int      $student_enrolled
 * @property int      $two_factor_confirmed_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $roles_id
 * @property int      $updated_at
 * @property int      $circle_points
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $status
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $status
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $referral_id
 * @property int      $role_id
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $gps_location_status
 * @property int      $is_online
 * @property int      $notification
 * @property int      $sms
 * @property int      $updated_at
 * @property int      $what_app
 * @property string   $designation
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $profile_photo_path
 * @property string   $remember_token
 * @property string   $two_factor_recovery_codes
 * @property string   $two_factor_secret
 * @property string   $company
 * @property string   $email
 * @property string   $firstName
 * @property string   $job_description
 * @property string   $lastName
 * @property string   $otp
 * @property string   $password
 * @property string   $referral_code
 * @property string   $remember_token
 * @property string   $selfie
 * @property string   $address
 * @property string   $bvn
 * @property string   $bvn_phone_number
 * @property string   $bvn_phone_number_verified
 * @property string   $device_name
 * @property string   $email
 * @property string   $face_id_token
 * @property string   $fcm_token
 * @property string   $first_name
 * @property string   $last_name
 * @property string   $middle_name
 * @property string   $otp
 * @property string   $password
 * @property string   $phone_number
 * @property string   $pin
 * @property string   $referral_code
 * @property string   $remember_token
 * @property string   $selfie
 * @property string   $username
 * @property string   $about
 * @property string   $address
 * @property string   $affiliate_token
 * @property string   $country_code
 * @property string   $email
 * @property string   $first_name
 * @property string   $gender
 * @property string   $id_card
 * @property string   $last_name
 * @property string   $mobile_otp
 * @property string   $otp
 * @property string   $password
 * @property string   $phone_number
 * @property string   $referral_token
 * @property string   $remember_token
 * @property string   $selfie_picture
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $remember_token
 * @property string   $address
 * @property string   $email
 * @property string   $gender
 * @property string   $image
 * @property string   $name
 * @property string   $password
 * @property string   $phone_number
 * @property string   $remember_token
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $referral_code
 * @property string   $remember_token
 * @property string   $bcc_address
 * @property string   $btc_address
 * @property string   $email
 * @property string   $eth_address
 * @property string   $name
 * @property string   $password
 * @property string   $profile_image
 * @property string   $referral_token
 * @property string   $remember_token
 * @property string   $usdt_address
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $remember_token
 * @property string   $email
 * @property string   $first_name
 * @property string   $last_name
 * @property string   $otp
 * @property string   $password
 * @property string   $phone
 * @property string   $referral_code
 * @property string   $remember_token
 * @property string   $referral_code
 * @property string   $age
 * @property string   $api_token
 * @property string   $country_code
 * @property string   $device_id
 * @property string   $device_name
 * @property string   $device_token
 * @property string   $device_type
 * @property string   $documents_approved
 * @property string   $email
 * @property string   $gender
 * @property string   $guarantor_address
 * @property string   $guarantor_email
 * @property string   $guarantor_name
 * @property string   $guarantor_phone_number
 * @property string   $id_prof
 * @property string   $location
 * @property string   $location_lat
 * @property string   $location_long
 * @property string   $mobile
 * @property string   $name
 * @property string   $otp
 * @property string   $password
 * @property string   $profile
 * @property string   $remember_token
 * @property string   $service_discription
 * @property string   $service_type
 * @property string   $service_type_price
 * @property string   $state
 * @property string   $town
 * @property string   $year_expreance
 * @property boolean  $has_purchased_course
 * @property boolean  $is_admin
 * @property boolean  $is_onboarded
 * @property boolean  $is_private
 * @property boolean  $is_affiliate
 * @property boolean  $is_id_verified
 * @property boolean  $is_phone_number_verified
 * @property boolean  $referral_confirmed
 * @property boolean  $is_account_locked
 * @property boolean  $is_active
 * @property boolean  $is_deleted
 * @property float    $affiliate_commission
 * @property DateTime $dob
 * @property DateTime $last_login_date
 */
class Users extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state', 'newColumn1', 'created_at', 'current_team_id', 'designation', 'email', 'email_verified_at', 'is_phone_verified', 'name', 'password', 'profile_photo_path', 'rating', 'remember_token', 'role_id', 'student_enrolled', 'two_factor_confirmed_at', 'two_factor_recovery_codes', 'two_factor_secret', 'updated_at', 'category_id', 'company', 'created_at', 'email', 'email_verified_at', 'firstName', 'has_purchased_course', 'industry_id', 'institution_id', 'is_admin', 'is_onboarded', 'job_description', 'lastName', 'otp', 'password', 'referral_code', 'referrer_id', 'remember_token', 'role_id', 'roles_id', 'selfie', 'subcategory_id', 'tutor_company_id', 'updated_at', 'address', 'bvn', 'bvn_phone_number', 'bvn_phone_number_verified', 'circle_points', 'created_at', 'device_name', 'email', 'email_verified_at', 'face_id_token', 'fcm_token', 'first_name', 'is_private', 'last_name', 'middle_name', 'otp', 'password', 'phone_number', 'pin', 'referral_code', 'referrer_id', 'remember_token', 'selfie', 'updated_at', 'username', 'about', 'address', 'affiliate_commission', 'affiliate_id', 'affiliate_token', 'city_id', 'country_code', 'country_id', 'created_at', 'dob', 'email', 'email_verified_at', 'first_name', 'gender', 'id_card', 'identification', 'is_affiliate', 'is_id_verified', 'is_phone_number_verified', 'last_name', 'mobile_otp', 'otp', 'password', 'phone_number', 'referral_balance', 'referral_confirmed', 'referral_token', 'referrer_id', 'remember_token', 'selfie_picture', 'state_id', 'status', 'updated_at', 'created_at', 'email', 'email_verified_at', 'name', 'password', 'remember_token', 'updated_at', 'address', 'created_at', 'email', 'email_verified_at', 'gender', 'image', 'name', 'password', 'phone_number', 'remember_token', 'status', 'updated_at', 'wallet_balance', 'created_at', 'email', 'email_verified_at', 'name', 'password', 'referral_code', 'referral_id', 'remember_token', 'role_id', 'updated_at', 'bcc_address', 'btc_address', 'created_at', 'earnings', 'email', 'email_verified_at', 'eth_address', 'name', 'password', 'profile_image', 'referral_token', 'referrer_id', 'remember_token', 'updated_at', 'usdt_address', 'created_at', 'email', 'email_verified_at', 'name', 'password', 'remember_token', 'updated_at', 'vendor_id', 'created_at', 'email', 'email_verified_at', 'first_name', 'is_account_locked', 'is_active', 'is_deleted', 'last_login_date', 'last_name', 'lender_id', 'merchant_id', 'otp', 'password', 'phone', 'referral_code', 'referrer_id', 'remember_token', 'role_id', 'updated_at', 'referral_code', 'referrer_id', 'age', 'api_token', 'country_code', 'created_at', 'device_id', 'device_name', 'device_token', 'device_type', 'documents_approved', 'email', 'email_verified_at', 'gender', 'gps_location_status', 'guarantor_address', 'guarantor_email', 'guarantor_name', 'guarantor_phone_number', 'id_prof', 'is_online', 'location', 'location_lat', 'location_long', 'mobile', 'name', 'notification', 'otp', 'password', 'profile', 'remember_token', 'service_discription', 'service_type', 'service_type_price', 'sms', 'state', 'status', 'town', 'type', 'updated_at', 'what_app', 'year_expreance'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'newColumn1' => 'int', 'created_at' => 'timestamp', 'designation' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'name' => 'string', 'password' => 'string', 'profile_photo_path' => 'string', 'rating' => 'int', 'remember_token' => 'string', 'role_id' => 'int', 'student_enrolled' => 'int', 'two_factor_confirmed_at' => 'timestamp', 'two_factor_recovery_codes' => 'string', 'two_factor_secret' => 'string', 'updated_at' => 'timestamp', 'company' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'firstName' => 'string', 'has_purchased_course' => 'boolean', 'is_admin' => 'boolean', 'is_onboarded' => 'boolean', 'job_description' => 'string', 'lastName' => 'string', 'otp' => 'string', 'password' => 'string', 'referral_code' => 'string', 'remember_token' => 'string', 'roles_id' => 'int', 'selfie' => 'string', 'updated_at' => 'timestamp', 'address' => 'string', 'bvn' => 'string', 'bvn_phone_number' => 'string', 'bvn_phone_number_verified' => 'string', 'circle_points' => 'int', 'created_at' => 'timestamp', 'device_name' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'face_id_token' => 'string', 'fcm_token' => 'string', 'first_name' => 'string', 'is_private' => 'boolean', 'last_name' => 'string', 'middle_name' => 'string', 'otp' => 'string', 'password' => 'string', 'phone_number' => 'string', 'pin' => 'string', 'referral_code' => 'string', 'remember_token' => 'string', 'selfie' => 'string', 'updated_at' => 'timestamp', 'username' => 'string', 'about' => 'string', 'address' => 'string', 'affiliate_commission' => 'double', 'affiliate_token' => 'string', 'country_code' => 'string', 'created_at' => 'timestamp', 'dob' => 'datetime', 'email' => 'string', 'email_verified_at' => 'timestamp', 'first_name' => 'string', 'gender' => 'string', 'id_card' => 'string', 'is_affiliate' => 'boolean', 'is_id_verified' => 'boolean', 'is_phone_number_verified' => 'boolean', 'last_name' => 'string', 'mobile_otp' => 'string', 'otp' => 'string', 'password' => 'string', 'phone_number' => 'string', 'referral_confirmed' => 'boolean', 'referral_token' => 'string', 'remember_token' => 'string', 'selfie_picture' => 'string', 'status' => 'int', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'name' => 'string', 'password' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'address' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'gender' => 'string', 'image' => 'string', 'name' => 'string', 'password' => 'string', 'phone_number' => 'string', 'remember_token' => 'string', 'status' => 'int', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'name' => 'string', 'password' => 'string', 'referral_code' => 'string', 'referral_id' => 'int', 'remember_token' => 'string', 'role_id' => 'int', 'updated_at' => 'timestamp', 'bcc_address' => 'string', 'btc_address' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'eth_address' => 'string', 'name' => 'string', 'password' => 'string', 'profile_image' => 'string', 'referral_token' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'usdt_address' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'name' => 'string', 'password' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'first_name' => 'string', 'is_account_locked' => 'boolean', 'is_active' => 'boolean', 'is_deleted' => 'boolean', 'last_login_date' => 'datetime', 'last_name' => 'string', 'otp' => 'string', 'password' => 'string', 'phone' => 'string', 'referral_code' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'referral_code' => 'string', 'age' => 'string', 'api_token' => 'string', 'country_code' => 'string', 'created_at' => 'timestamp', 'device_id' => 'string', 'device_name' => 'string', 'device_token' => 'string', 'device_type' => 'string', 'documents_approved' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'gender' => 'string', 'gps_location_status' => 'int', 'guarantor_address' => 'string', 'guarantor_email' => 'string', 'guarantor_name' => 'string', 'guarantor_phone_number' => 'string', 'id_prof' => 'string', 'is_online' => 'int', 'location' => 'string', 'location_lat' => 'string', 'location_long' => 'string', 'mobile' => 'string', 'name' => 'string', 'notification' => 'int', 'otp' => 'string', 'password' => 'string', 'profile' => 'string', 'remember_token' => 'string', 'service_discription' => 'string', 'service_type' => 'string', 'service_type_price' => 'string', 'sms' => 'int', 'state' => 'string', 'town' => 'string', 'updated_at' => 'timestamp', 'what_app' => 'int', 'year_expreance' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'email_verified_at', 'two_factor_confirmed_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'dob', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at', 'created_at', 'email_verified_at', 'last_login_date', 'updated_at', 'created_at', 'email_verified_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}