<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string   $id
 * @property string   $id
 * @property string   $access_token_id
 * @property string   $access_token_id
 * @property DateTime $expires_at
 * @property DateTime $expires_at
 * @property boolean  $revoked
 * @property boolean  $revoked
 */
class OauthRefreshTokens extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_refresh_tokens';

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
        'access_token_id', 'expires_at', 'revoked', 'access_token_id', 'expires_at', 'revoked'
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
        'id' => 'string', 'id' => 'string', 'access_token_id' => 'string', 'expires_at' => 'datetime', 'revoked' => 'boolean', 'access_token_id' => 'string', 'expires_at' => 'datetime', 'revoked' => 'boolean'
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
