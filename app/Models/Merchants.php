<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $address
 * @property string  $business_name
 * @property string  $city
 * @property string  $code
 * @property string  $document
 * @property string  $industry
 * @property string  $merchant
 * @property string  $phone
 * @property string  $reg_number
 * @property string  $state
 * @property string  $tin
 * @property string  $website
 * @property string  $zip
 * @property int     $created_at
 * @property int     $is_kyc_submitted
 * @property int     $status
 * @property int     $updated_at
 * @property boolean $is_verified
 */
class Merchants extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchants';

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
        'address', 'business_name', 'city', 'code', 'country_id', 'created_at', 'document', 'industry', 'is_kyc_submitted', 'is_verified', 'merchant', 'phone', 'reg_number', 'state', 'status', 'tin', 'updated_at', 'website', 'zip'
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
        'address' => 'string', 'business_name' => 'string', 'city' => 'string', 'code' => 'string', 'created_at' => 'timestamp', 'document' => 'string', 'industry' => 'string', 'is_kyc_submitted' => 'int', 'is_verified' => 'boolean', 'merchant' => 'string', 'phone' => 'string', 'reg_number' => 'string', 'state' => 'string', 'status' => 'int', 'tin' => 'string', 'updated_at' => 'timestamp', 'website' => 'string', 'zip' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
