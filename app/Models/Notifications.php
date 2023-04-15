<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $read_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $read_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $read_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $type
 * @property int    $updated_at
 * @property int    $user_id
 * @property string $data
 * @property string $notifiable_type
 * @property string $type
 * @property string $data
 * @property string $notifiable_type
 * @property string $type
 * @property string $data
 * @property string $notifiable_type
 * @property string $type
 * @property string $message
 * @property string $title
 */
class Notifications extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

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
        'created_at', 'data', 'notifiable_id', 'notifiable_type', 'read_at', 'type', 'updated_at', 'created_at', 'data', 'notifiable_id', 'notifiable_type', 'read_at', 'type', 'updated_at', 'created_at', 'data', 'notifiable_id', 'notifiable_type', 'read_at', 'type', 'updated_at', 'created_at', 'message', 'title', 'type', 'updated_at', 'user_id'
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
        'created_at' => 'timestamp', 'data' => 'string', 'notifiable_type' => 'string', 'read_at' => 'timestamp', 'type' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'data' => 'string', 'notifiable_type' => 'string', 'read_at' => 'timestamp', 'type' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'data' => 'string', 'notifiable_type' => 'string', 'read_at' => 'timestamp', 'type' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'message' => 'string', 'title' => 'string', 'type' => 'int', 'updated_at' => 'timestamp', 'user_id' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'read_at', 'updated_at', 'created_at', 'read_at', 'updated_at', 'created_at', 'read_at', 'updated_at', 'created_at', 'updated_at'
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
