<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $account_number
 * @property string $bank
 * @property string $customer_id
 * @property string $holder_name
 * @property int    $created_at
 * @property int    $updated_at
 */
class CustomerAccounts extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_accounts';

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
        'account_number', 'bank', 'created_at', 'customer_id', 'holder_name', 'updated_at'
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
        'account_number' => 'string', 'bank' => 'string', 'created_at' => 'timestamp', 'customer_id' => 'string', 'holder_name' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
