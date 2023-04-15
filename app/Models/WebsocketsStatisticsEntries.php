<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $api_message_count
 * @property int    $created_at
 * @property int    $peak_connection_count
 * @property int    $updated_at
 * @property int    $websocket_message_count
 * @property string $app_id
 */
class WebsocketsStatisticsEntries extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'websockets_statistics_entries';

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
        'api_message_count', 'app_id', 'created_at', 'peak_connection_count', 'updated_at', 'websocket_message_count'
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
        'id' => 'int', 'api_message_count' => 'int', 'app_id' => 'string', 'created_at' => 'timestamp', 'peak_connection_count' => 'int', 'updated_at' => 'timestamp', 'websocket_message_count' => 'int'
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
