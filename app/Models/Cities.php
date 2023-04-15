<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $status
 * @property int      $updated_at
 * @property string   $city_name
 * @property string   $country_id
 * @property string   $state_id
 * @property string   $status
 * @property string   $name
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Cities extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

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
        'city_name', 'country_id', 'created_at', 'state_id', 'status', 'updated_at', 'created_at', 'name', 'state_id', 'status', 'updated_at'
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
        'id' => 'int', 'city_name' => 'string', 'country_id' => 'string', 'created_at' => 'datetime', 'state_id' => 'string', 'status' => 'string', 'updated_at' => 'datetime', 'created_at' => 'timestamp', 'name' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
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
