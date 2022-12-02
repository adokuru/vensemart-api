<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $created_at
 * @property int     $updated_at
 * @property int     $created_at
 * @property int     $updated_at
 * @property string  $name
 * @property string  $provider
 * @property string  $redirect
 * @property string  $secret
 * @property string  $name
 * @property string  $provider
 * @property string  $redirect
 * @property string  $secret
 * @property boolean $password_client
 * @property boolean $personal_access_client
 * @property boolean $revoked
 * @property boolean $password_client
 * @property boolean $personal_access_client
 * @property boolean $revoked
 */
class OauthClients extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

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
        'created_at', 'name', 'password_client', 'personal_access_client', 'provider', 'redirect', 'revoked', 'secret', 'updated_at', 'user_id', 'created_at', 'name', 'password_client', 'personal_access_client', 'provider', 'redirect', 'revoked', 'secret', 'updated_at', 'user_id'
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
        'created_at' => 'timestamp', 'name' => 'string', 'password_client' => 'boolean', 'personal_access_client' => 'boolean', 'provider' => 'string', 'redirect' => 'string', 'revoked' => 'boolean', 'secret' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'name' => 'string', 'password_client' => 'boolean', 'personal_access_client' => 'boolean', 'provider' => 'string', 'redirect' => 'string', 'revoked' => 'boolean', 'secret' => 'string', 'updated_at' => 'timestamp'
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
