<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $status
 * @property int      $updated_at
 * @property string   $name
 * @property string   $country_code
 * @property string   $country_name
 * @property string   $status
 * @property string   $code
 * @property string   $name
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Countries extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

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
        'created_at', 'name', 'updated_at', 'country_code', 'country_name', 'created_at', 'status', 'updated_at', 'code', 'created_at', 'name', 'status', 'updated_at'
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
        'id' => 'int', 'created_at' => 'timestamp', 'name' => 'string', 'updated_at' => 'timestamp', 'country_code' => 'string', 'country_name' => 'string', 'created_at' => 'datetime', 'status' => 'string', 'updated_at' => 'datetime', 'code' => 'string', 'created_at' => 'timestamp', 'name' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
