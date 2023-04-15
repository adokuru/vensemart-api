<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $created_at
 * @property int      $updated_at
 * @property boolean  $is_group
 * @property string   $last_message
 * @property DateTime $last_message_at
 */
class Chats extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chats';

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
        'circle_id', 'created_at', 'is_group', 'last_message', 'last_message_at', 'updated_at'
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
        'created_at' => 'timestamp', 'is_group' => 'boolean', 'last_message' => 'string', 'last_message_at' => 'datetime', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'last_message_at', 'updated_at'
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
