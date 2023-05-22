<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property string   $address
 * @property string   $franchise_id
 * @property string   $lati
 * @property string   $longi
 * @property string   $store_image
 * @property string   $store_name
 * @property DateTime $updated_at
 */
class Stores extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';

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
        'address', 'created_at', 'franchise_id', 
        'lati', 'longi', 'status', 'store_image', 'store_name', 'updated_at'
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
        'id' => 'int', 'address' => 'string', 'created_at' => 'timestamp', 'franchise_id' => 'string', 'lati' => 'string', 'longi' => 'string', 'store_image' => 'string', 'store_name' => 'string', 'updated_at' => 'datetime'
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
