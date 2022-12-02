<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $amount
 * @property int    $created_at
 * @property int    $service_provider_id
 * @property int    $status
 * @property int    $subscription_plan_id
 * @property int    $updated_at
 * @property int    $validity
 * @property string $plan_name
 * @property string $transaction_id
 * @property Date   $purchase_date
 */
class ServicePlanPurchase extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_plan_purchase';

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
        'amount', 'created_at', 'plan_name', 'purchase_date', 'service_provider_id', 'status', 'subscription_plan_id', 'transaction_id', 'updated_at', 'validity'
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
        'id' => 'int', 'amount' => 'int', 'created_at' => 'timestamp', 'plan_name' => 'string', 'purchase_date' => 'date', 'service_provider_id' => 'int', 'status' => 'int', 'subscription_plan_id' => 'int', 'transaction_id' => 'string', 'updated_at' => 'timestamp', 'validity' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'purchase_date', 'updated_at'
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
