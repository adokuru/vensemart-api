<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class RoleHasPermissions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_has_permissions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'role_id', 'role_id', 'role_id'
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
        
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        
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
