<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $amount
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $reference
 * @property string $status
 * @property string $account_holder_name
 * @property string $acount_number
 * @property string $bank_name
 * @property string $email
 * @property string $user_id
 */
class Withdrawals extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'withdrawals';

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
        'created_at', 'reference', 'status', 'updated_at', 'user_id', 'value', 'amount', 'bank_account_id', 'created_at', 'status', 'updated_at', 'user_id', 'account_holder_name', 'acount_number', 'amount', 'bank_name', 'created_at', 'email', 'updated_at', 'user_id', 'user_type'
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
        'created_at' => 'timestamp', 'reference' => 'string', 'status' => 'int', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'status' => 'string', 'updated_at' => 'timestamp', 'account_holder_name' => 'string', 'acount_number' => 'string', 'amount' => 'int', 'bank_name' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'updated_at' => 'timestamp', 'user_id' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
