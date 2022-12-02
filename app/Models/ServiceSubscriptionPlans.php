<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $created_at
 * @property int    $days
 * @property int    $status
 * @property int    $updated_at
 * @property string $amount
 * @property string $discription
 * @property string $plan_type
 * @property string $s_amount
 */
class ServiceSubscriptionPlans extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_subscription_plans';

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
        'amount', 'created_at', 'days', 'discription', 'plan_type', 's_amount', 'status', 'updated_at'
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
        'id' => 'int', 'amount' => 'string', 'created_at' => 'timestamp', 'days' => 'int', 'discription' => 'string', 'plan_type' => 'string', 's_amount' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
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
