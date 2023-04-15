<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property string $loc_lat
 * @property string $loc_long
 * @property string $location
 * @property string $user_id
 */
class ServiceGpsLocation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_gps_location';

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
        'created_at', 'loc_lat', 'loc_long', 'location', 'status', 'updated_at', 'user_id'
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
        'id' => 'int', 'created_at' => 'timestamp', 'loc_lat' => 'string', 'loc_long' => 'string', 'location' => 'string', 'status' => 'int', 'updated_at' => 'timestamp', 'user_id' => 'string'
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
