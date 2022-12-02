<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string   $id
 * @property string   $id
 * @property string   $scopes
 * @property string   $scopes
 * @property DateTime $expires_at
 * @property DateTime $expires_at
 * @property boolean  $revoked
 * @property boolean  $revoked
 */
class OauthAuthCodes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_auth_codes';

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
        'client_id', 'expires_at', 'revoked', 'scopes', 'user_id', 'client_id', 'expires_at', 'revoked', 'scopes', 'user_id'
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
        'id' => 'string', 'id' => 'string', 'expires_at' => 'datetime', 'revoked' => 'boolean', 'scopes' => 'string', 'expires_at' => 'datetime', 'revoked' => 'boolean', 'scopes' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at', 'expires_at'
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
