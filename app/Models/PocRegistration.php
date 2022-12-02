<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $admin_status
 * @property int      $created_at
 * @property int      $franchise_satus
 * @property int      $is_verified
 * @property int      $kyc_status
 * @property int      $ts
 * @property string   $ac_no
 * @property string   $acc_name
 * @property string   $activation_date
 * @property string   $address
 * @property string   $bank_nm
 * @property string   $branch_nm
 * @property string   $city
 * @property string   $country
 * @property string   $country_code
 * @property string   $current_login_date
 * @property string   $email
 * @property string   $first_name
 * @property string   $franchise_category
 * @property string   $gender
 * @property string   $gst
 * @property string   $id_card
 * @property string   $id_no
 * @property string   $image
 * @property string   $last_login_date
 * @property string   $last_name
 * @property string   $lati
 * @property string   $lendmark
 * @property string   $longi
 * @property string   $merried_status
 * @property string   $password
 * @property string   $ref_id
 * @property string   $registration_date
 * @property string   $state
 * @property string   $swift_code
 * @property string   $telephone
 * @property string   $user_id
 * @property string   $user_status
 * @property string   $username
 * @property string   $zipcode
 * @property DateTime $updated_at
 */
class PocRegistration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'poc_registration';

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
        'ac_no', 'acc_name', 'activation_date', 'address', 'admin_status', 'bank_nm', 'branch_nm', 'city', 'country', 'country_code', 'created_at', 'current_login_date', 'email', 'first_name', 'franchise_category', 'franchise_satus', 'gender', 'gst', 'id_card', 'id_no', 'image', 'is_verified', 'kyc_status', 'last_login_date', 'last_name', 'lati', 'lendmark', 'longi', 'merried_status', 'password', 'ref_id', 'registration_date', 'state', 'swift_code', 'telephone', 'ts', 'updated_at', 'user_id', 'user_status', 'username', 'zipcode'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'ac_no' => 'string', 'acc_name' => 'string', 'activation_date' => 'string', 'address' => 'string', 'admin_status' => 'int', 'bank_nm' => 'string', 'branch_nm' => 'string', 'city' => 'string', 'country' => 'string', 'country_code' => 'string', 'created_at' => 'timestamp', 'current_login_date' => 'string', 'email' => 'string', 'first_name' => 'string', 'franchise_category' => 'string', 'franchise_satus' => 'int', 'gender' => 'string', 'gst' => 'string', 'id_card' => 'string', 'id_no' => 'string', 'image' => 'string', 'is_verified' => 'int', 'kyc_status' => 'int', 'last_login_date' => 'string', 'last_name' => 'string', 'lati' => 'string', 'lendmark' => 'string', 'longi' => 'string', 'merried_status' => 'string', 'password' => 'string', 'ref_id' => 'string', 'registration_date' => 'string', 'state' => 'string', 'swift_code' => 'string', 'telephone' => 'string', 'ts' => 'timestamp', 'updated_at' => 'datetime', 'user_id' => 'string', 'user_status' => 'string', 'username' => 'string', 'zipcode' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'ts', 'updated_at'
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
