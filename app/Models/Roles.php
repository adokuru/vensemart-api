<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $guard_name
 * @property string $name
 * @property string $guard_name
 * @property string $name
 * @property string $role_name
 * @property string $description
 * @property string $name
 * @property string $name
 * @property string $guard_name
 * @property string $name
 * @property string $guard_name
 * @property string $name
 */
class Roles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
        'created_at', 'guard_name', 'name', 'updated_at', 'created_at', 'guard_name', 'name', 'updated_at', 'created_at', 'role_name', 'updated_at', 'created_at', 'description', 'name', 'updated_at', 'created_at', 'name', 'updated_at', 'created_at', 'guard_name', 'name', 'updated_at', 'created_at', 'guard_name', 'name', 'updated_at'
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
        'created_at' => 'timestamp', 'guard_name' => 'string', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'guard_name' => 'string', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'role_name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'description' => 'string', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'guard_name' => 'string', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'guard_name' => 'string', 'name' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
