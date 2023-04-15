<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $default_payment_method
 * @property string $default_payment_method_description
 * @property string $default_payment_method_name
 * @property string $default_payment_method_type
 * @property string $email
 * @property string $logo
 * @property string $name
 * @property string $phone
 * @property string $rc_number
 * @property string $state
 * @property string $tax_number
 * @property string $vat_number
 * @property string $website
 * @property string $zip
 * @property int    $created_at
 * @property int    $updated_at
 */
class Companies extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
        'address', 'city', 'country', 'created_at', 'default_payment_method', 'default_payment_method_description', 'default_payment_method_name', 'default_payment_method_type', 'email', 'logo', 'name', 'phone', 'rc_number', 'state', 'tax_number', 'updated_at', 'vat_number', 'website', 'zip'
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
        'address' => 'string', 'city' => 'string', 'country' => 'string', 'created_at' => 'timestamp', 'default_payment_method' => 'string', 'default_payment_method_description' => 'string', 'default_payment_method_name' => 'string', 'default_payment_method_type' => 'string', 'email' => 'string', 'logo' => 'string', 'name' => 'string', 'phone' => 'string', 'rc_number' => 'string', 'state' => 'string', 'tax_number' => 'string', 'updated_at' => 'timestamp', 'vat_number' => 'string', 'website' => 'string', 'zip' => 'string'
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
