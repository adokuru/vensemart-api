<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $address
 * @property string   $type
 * @property string   $user_id
 * @property string   $user_lat
 * @property string   $user_long
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class AddAddressUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'add_address_user';

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
        'address', 'created_at', 'type', 'updated_at', 'user_id', 'user_lat', 'user_long'
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
        'id' => 'int', 'address' => 'string', 'created_at' => 'datetime', 'type' => 'string', 'updated_at' => 'datetime', 'user_id' => 'string', 'user_lat' => 'string', 'user_long' => 'string'
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
