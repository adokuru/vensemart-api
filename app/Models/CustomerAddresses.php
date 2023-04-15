<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $additional_address
 * @property string  $address
 * @property string  $contact_name
 * @property string  $contact_number
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $is_default
 */
class CustomerAddresses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_addresses';

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
        'additional_address', 'address', 'contact_name', 'contact_number', 'created_at', 'is_default', 'updated_at', 'user_uid'
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
        'additional_address' => 'string', 'address' => 'string', 'contact_name' => 'string', 'contact_number' => 'string', 'created_at' => 'timestamp', 'is_default' => 'boolean', 'updated_at' => 'timestamp'
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
