<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_at
 * @property int $updated_at
 */
class OauthPersonalAccessClients extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_personal_access_clients';

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
        'client_id', 'created_at', 'updated_at', 'client_id', 'created_at', 'updated_at'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
