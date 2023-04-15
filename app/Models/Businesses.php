<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address_proof
 * @property string $business_name
 * @property string $cac
 * @property string $email
 * @property string $logo
 * @property string $nipost
 * @property string $phone_number
 * @property string $tin
 * @property string $website
 * @property int    $created_at
 * @property int    $email_verified_at
 * @property int    $updated_at
 */
class Businesses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'businesses';

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
        'address_proof', 'base_fare', 'business_name', 'cac', 'created_at', 'email', 'email_verified_at', 'logo', 'nipost', 'phone_number', 'price_per_kg', 'price_per_km', 'price_per_min', 'status', 'tin', 'updated_at', 'website'
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
        'address_proof' => 'string', 'business_name' => 'string', 'cac' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'logo' => 'string', 'nipost' => 'string', 'phone_number' => 'string', 'tin' => 'string', 'updated_at' => 'timestamp', 'website' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'email_verified_at', 'updated_at'
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
