<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string   $id
 * @property string   $id
 * @property string   $name
 * @property string   $scopes
 * @property string   $name
 * @property string   $scopes
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $updated_at
 * @property DateTime $expires_at
 * @property DateTime $expires_at
 * @property boolean  $revoked
 * @property boolean  $revoked
 */
class OauthAccessTokens extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_access_tokens';

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
        'client_id', 'created_at', 'expires_at', 'name', 'revoked', 'scopes', 'updated_at', 'user_id', 'client_id', 'created_at', 'expires_at', 'name', 'revoked', 'scopes', 'updated_at', 'user_id'
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
        'id' => 'string', 'id' => 'string', 'created_at' => 'timestamp', 'expires_at' => 'datetime', 'name' => 'string', 'revoked' => 'boolean', 'scopes' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'expires_at' => 'datetime', 'name' => 'string', 'revoked' => 'boolean', 'scopes' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'expires_at', 'updated_at', 'created_at', 'expires_at', 'updated_at'
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
