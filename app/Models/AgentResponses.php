<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $agent_response
 * @property string $description
 * @property string $order_id
 * @property string $status
 * @property int    $created_at
 * @property int    $updated_at
 */
class AgentResponses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agent_responses';

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
        'agent_response', 'created_at', 'description', 'order_id', 'status', 'updated_at'
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
        'agent_response' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'order_id' => 'string', 'status' => 'string', 'updated_at' => 'timestamp'
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
