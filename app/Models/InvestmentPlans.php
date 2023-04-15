<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $contract_duration
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $description
 * @property string $name
 * @property string $contract_duration
 * @property string $description
 * @property string $fixed_return_rate
 * @property string $flexible_return_rate
 * @property string $maximum_price
 * @property string $minimum_price
 * @property string $name
 */
class InvestmentPlans extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'investment_plans';

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
        'contract_duration', 'created_at', 'description', 'maximum_price', 'minimum_price', 'name', 'return_rate', 'updated_at', 'contract_duration', 'created_at', 'description', 'fixed_return_rate', 'flexible_return_rate', 'investment_type_id', 'maximum_price', 'minimum_price', 'name', 'updated_at'
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
        'contract_duration' => 'int', 'created_at' => 'timestamp', 'description' => 'string', 'name' => 'string', 'updated_at' => 'timestamp', 'contract_duration' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'fixed_return_rate' => 'string', 'flexible_return_rate' => 'string', 'maximum_price' => 'string', 'minimum_price' => 'string', 'name' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at'
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
