<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $status
 * @property int    $type
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $payment_reference
 * @property string $payment_status
 * @property string $reference
 * @property string $currency
 * @property string $payment_method
 * @property string $reference
 * @property string $status
 * @property string $description
 * @property string $reference
 * @property string $amount
 * @property string $payment_for
 * @property string $reference
 * @property string $transaction_type
 * @property string $currency
 * @property string $status
 * @property string $currency
 * @property string $status
 * @property string $transaction_type
 */
class Transactions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
        'created_at', 'updated_at', 'amount', 'course_id', 'created_at', 'payment_method', 'payment_reference', 'payment_status', 'reference', 'status', 'transaction_type', 'updated_at', 'user_id', 'amount', 'circle_id', 'created_at', 'currency', 'investment_id', 'payment_method', 'reference', 'response', 'status', 'transaction_type_id', 'updated_at', 'user_id', 'amount', 'created_at', 'description', 'payment_method', 'property_id', 'reference', 'status', 'type', 'updated_at', 'user_id', 'amount', 'created_at', 'order_id', 'payment_for', 'payment_type', 'reference', 'status', 'transaction_type', 'updated_at', 'user_id', 'amount', 'created_at', 'currency', 'deposit_id', 'investment_plan_id', 'status', 'transactions_type_id', 'updated_at', 'user_id', 'wallet_id', 'withdrawal_id', 'amount', 'created_at', 'currency', 'deposit_id', 'investment_plan_id', 'status', 'transaction_type', 'updated_at', 'user_id', 'wallet_id', 'withdrawal_id'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'payment_reference' => 'string', 'payment_status' => 'string', 'reference' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'currency' => 'string', 'payment_method' => 'string', 'reference' => 'string', 'status' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'description' => 'string', 'reference' => 'string', 'status' => 'int', 'type' => 'int', 'updated_at' => 'timestamp', 'amount' => 'string', 'created_at' => 'timestamp', 'payment_for' => 'string', 'reference' => 'string', 'transaction_type' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'currency' => 'string', 'status' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'currency' => 'string', 'status' => 'string', 'transaction_type' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at'
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
