<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $created_at
 * @property int     $deleted_at
 * @property int     $notifyable_id
 * @property int     $updated_at
 * @property string  $display_name
 * @property string  $model
 * @property string  $notifyable_type
 * @property string  $platform
 * @property string  $push_token
 * @property string  $uuid
 * @property string  $version
 * @property boolean $is_active
 */
class FcmUserDevices extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fcm_user_devices';

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
        'created_at', 'deleted_at', 'display_name', 'is_active', 'model', 'notifyable_id', 'notifyable_type', 'platform', 'push_token', 'updated_at', 'uuid', 'version'
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
        'created_at' => 'timestamp', 'deleted_at' => 'timestamp', 'display_name' => 'string', 'is_active' => 'boolean', 'model' => 'string', 'notifyable_id' => 'int', 'notifyable_type' => 'string', 'platform' => 'string', 'push_token' => 'string', 'updated_at' => 'timestamp', 'uuid' => 'string', 'version' => 'string'
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
