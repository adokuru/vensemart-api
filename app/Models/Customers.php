<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $bvn
 * @property string  $city
 * @property string  $code
 * @property string  $current_reason
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $mean_of_identification_image
 * @property string  $middle_name
 * @property string  $occupation
 * @property string  $otp
 * @property string  $passport_photograph
 * @property string  $phone
 * @property string  $residential_address
 * @property string  $state
 * @property int     $created_at
 * @property int     $is_kyc_verified_by_lender
 * @property int     $status
 * @property int     $updated_at
 * @property int     $verified_by
 * @property Date    $date_account_verified
 * @property Date    $date_phone_verified
 * @property boolean $is_account_verified
 * @property boolean $is_phone_verified
 */
class Customers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
        'bvn', 'city', 'code', 'country_id', 'created_at', 'current_reason', 'date_account_verified', 'date_phone_verified', 'first_name', 'is_account_verified', 'is_kyc_verified_by_lender', 'is_phone_verified', 'last_name', 'mean_of_identification_id', 'mean_of_identification_image', 'middle_name', 'occupation', 'otp', 'passport_photograph', 'phone', 'residential_address', 'state', 'status', 'updated_at', 'user_id', 'verified_by'
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
        'bvn' => 'string', 'city' => 'string', 'code' => 'string', 'created_at' => 'timestamp', 'current_reason' => 'string', 'date_account_verified' => 'date', 'date_phone_verified' => 'date', 'first_name' => 'string', 'is_account_verified' => 'boolean', 'is_kyc_verified_by_lender' => 'int', 'is_phone_verified' => 'boolean', 'last_name' => 'string', 'mean_of_identification_image' => 'string', 'middle_name' => 'string', 'occupation' => 'string', 'otp' => 'string', 'passport_photograph' => 'string', 'phone' => 'string', 'residential_address' => 'string', 'state' => 'string', 'status' => 'int', 'updated_at' => 'timestamp', 'verified_by' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'date_account_verified', 'date_phone_verified', 'updated_at'
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
