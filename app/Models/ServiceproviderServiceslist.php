<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $address
 * @property string   $description
 * @property string   $image
 * @property string   $latitude
 * @property string   $longtitude
 * @property string   $price
 * @property string   $service_categoryid
 * @property string   $serviceprovider_id
 * @property string   $shop_mobilenumber
 * @property string   $shop_name
 * @property string   $status
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class ServiceproviderServiceslist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'serviceprovider_serviceslist';

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
        'address', 'created_at', 'description', 'image', 'latitude', 'longtitude', 'price', 'service_categoryid', 'serviceprovider_id', 'shop_mobilenumber', 'shop_name', 'status', 'updated_at'
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
        'id' => 'int', 'address' => 'string', 'created_at' => 'datetime', 'description' => 'string', 'image' => 'string', 'latitude' => 'string', 'longtitude' => 'string', 'price' => 'string', 'service_categoryid' => 'string', 'serviceprovider_id' => 'string', 'shop_mobilenumber' => 'string', 'shop_name' => 'string', 'status' => 'string', 'updated_at' => 'datetime'
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
