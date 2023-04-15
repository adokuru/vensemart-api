<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $base_fare
 * @property string $price_km
 * @property string $weight_distance
 * @property int    $created_at
 * @property int    $updated_at
 */
class PriceCenters extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price_centers';

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
        'base_fare', 'business_id', 'created_at', 'is_default', 'price_km', 'type_id', 'updated_at', 'weight_distance'
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
        'base_fare' => 'string', 'created_at' => 'timestamp', 'price_km' => 'string', 'updated_at' => 'timestamp', 'weight_distance' => 'string'
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
