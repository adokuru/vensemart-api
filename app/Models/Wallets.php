<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $user_type
 * @property string $user_type
 * @property string $description
 * @property string $holder_type
 * @property string $name
 * @property string $slug
 * @property string $account_number
 * @property string $bank
 * @property string $holder_name
 */
class Wallets extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wallets';

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
        'amount', 'created_at', 'status', 'updated_at', 'usd_balance', 'user_id', 'wallet_type_id', 'amount', 'created_at', 'status', 'updated_at', 'usd_balance', 'user_id', 'wallet_type_id', 'created_at', 'raw_balance', 'updated_at', 'user_id', 'user_type', 'wallet_type_id', 'created_at', 'raw_balance', 'updated_at', 'user_id', 'user_type', 'wallet_type_id', 'balance', 'created_at', 'decimal_places', 'description', 'holder_id', 'holder_type', 'meta', 'name', 'slug', 'updated_at', 'uuid', 'account_number', 'bank', 'created_at', 'holder_name', 'updated_at'
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
        'created_at' => 'timestamp', 'status' => 'int', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'status' => 'int', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'user_type' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'user_type' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'holder_type' => 'string', 'name' => 'string', 'slug' => 'string', 'updated_at' => 'timestamp', 'account_number' => 'string', 'bank' => 'string', 'created_at' => 'timestamp', 'holder_name' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
