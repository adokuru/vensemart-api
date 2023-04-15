<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $user_id
 * @property string   $address
 * @property string   $city
 * @property string   $locality
 * @property string   $pincode
 * @property string   $state
 * @property DateTime $updated_at
 */
class UserAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_address';

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
        'address', 'city', 'created_at', 'locality', 'pincode', 'state', 'type', 'updated_at', 'user_id'
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
        'id' => 'int', 'address' => 'string', 'city' => 'string', 'created_at' => 'timestamp', 'locality' => 'string', 'pincode' => 'string', 'state' => 'string', 'updated_at' => 'datetime', 'user_id' => 'int'
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
