<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $account_number
 * @property string $address
 * @property string $bank
 * @property string $city
 * @property string $country
 * @property string $email
 * @property string $logo
 * @property string $name
 * @property string $phone
 * @property string $state
 * @property string $website
 * @property string $zip
 * @property int    $created_at
 * @property int    $updated_at
 */
class Vendors extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendors';

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
        'account_number', 'address', 'bank', 'city', 'company_id', 'country', 'created_at', 'email', 'logo', 'name', 'phone', 'state', 'ticket_type_id', 'updated_at', 'website', 'zip'
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
        'account_number' => 'string', 'address' => 'string', 'bank' => 'string', 'city' => 'string', 'country' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'logo' => 'string', 'name' => 'string', 'phone' => 'string', 'state' => 'string', 'updated_at' => 'timestamp', 'website' => 'string', 'zip' => 'string'
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
