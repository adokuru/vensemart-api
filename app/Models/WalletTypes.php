<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $description
 * @property string $getSymbol
 * @property string $icon
 * @property string $name
 * @property string $qrcode
 * @property string $symbol
 * @property string $name
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $getSymbol
 * @property string $icon
 * @property string $name
 * @property string $qrcode
 * @property string $symbol
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $decimals
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $decimals
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 */
class WalletTypes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wallet_types';

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
        'address', 'created_at', 'description', 'getSymbol', 'icon', 'name', 'qrcode', 'status', 'symbol', 'updated_at', 'value', 'created_at', 'decimals', 'name', 'updated_at', 'created_at', 'decimals', 'name', 'updated_at', 'address', 'created_at', 'description', 'getSymbol', 'icon', 'name', 'qrcode', 'status', 'symbol', 'updated_at', 'value'
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
        'address' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'getSymbol' => 'string', 'icon' => 'string', 'name' => 'string', 'qrcode' => 'string', 'status' => 'int', 'symbol' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'decimals' => 'int', 'name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'decimals' => 'int', 'name' => 'string', 'updated_at' => 'timestamp', 'address' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'getSymbol' => 'string', 'icon' => 'string', 'name' => 'string', 'qrcode' => 'string', 'status' => 'int', 'symbol' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
