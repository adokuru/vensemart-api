<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $user_id
 * @property string $description
 * @property string $message
 * @property string $type
 * @property Date   $from
 * @property Date   $to
 */
class Leaves extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leaves';

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
        'created_at', 'description', 'from', 'message', 'status', 'to', 'type', 'updated_at', 'user_id'
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
        'created_at' => 'timestamp', 'description' => 'string', 'from' => 'date', 'message' => 'string', 'status' => 'int', 'to' => 'date', 'type' => 'string', 'updated_at' => 'timestamp', 'user_id' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'from', 'to', 'updated_at'
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
