<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $model_type
 * @property string $model_type
 * @property string $model_type
 * @property string $model_type
 */
class ModelHasPermissions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'model_has_permissions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'model_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type', 'permission_id', 'model_type', 'permission_id', 'model_type', 'permission_id', 'model_type', 'permission_id'
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
        'model_type' => 'string', 'model_type' => 'string', 'model_type' => 'string', 'model_type' => 'string'
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
