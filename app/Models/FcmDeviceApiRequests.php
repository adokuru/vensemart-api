<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $deleted_at
 * @property int    $updated_at
 * @property string $ip
 * @property string $path
 */
class FcmDeviceApiRequests extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fcm_device_api_requests';

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
        'created_at', 'deleted_at', 'fcm_user_device_id', 'ip', 'path', 'updated_at'
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
        'created_at' => 'timestamp', 'deleted_at' => 'timestamp', 'ip' => 'string', 'path' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'deleted_at', 'updated_at'
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
