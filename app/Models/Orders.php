<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $status
 * @property int      $tenor
 * @property int      $updated_at
 * @property int      $address_id
 * @property int      $created_at
 * @property int      $driver_id
 * @property int      $offer_id
 * @property int      $reject_driver_id
 * @property int      $shop_id
 * @property int      $total_item
 * @property int      $user_id
 * @property string   $merchant_order_id
 * @property string   $takke_order_id
 * @property string   $cancel_reason
 * @property string   $invoice_no
 * @property string   $order_id
 * @property string   $other_reason
 * @property string   $otp
 * @property string   $purchase_date
 * @property string   $transaction_id
 * @property DateTime $order_date
 * @property DateTime $updated_at
 * @property float    $delivery_charge
 * @property float    $net_amount
 * @property float    $offer_amount
 * @property float    $refund_amount
 * @property float    $taxes
 * @property float    $total_amount
 * @property Date     $order_date
 */
class Orders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
        'created_at', 'customer_id', 'lender_id', 'lender_interest_rates_id', 'merchant_id', 'merchant_order_id', 'order_amount', 'order_date', 'shipping_amount', 'status', 'takke_order_id', 'tax_amount', 'tenor', 'total_amount', 'updated_at', 'address_id', 'cancel_by', 'cancel_reason', 'created_at', 'delivery_charge', 'driver_id', 'expected_time', 'invoice_no', 'net_amount', 'offer_amount', 'offer_id', 'order_date', 'order_id', 'other_reason', 'otp', 'payment_status', 'payment_type', 'purchase_date', 'refund_amount', 'reject_driver_id', 'return_request_status', 'shop_id', 'status', 'taxes', 'total_amount', 'total_item', 'transaction_id', 'updated_at', 'user_id'
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
        'id' => 'int', 'created_at' => 'timestamp', 'merchant_order_id' => 'string', 'order_date' => 'datetime', 'status' => 'int', 'takke_order_id' => 'string', 'tenor' => 'int', 'updated_at' => 'timestamp', 'address_id' => 'int', 'cancel_reason' => 'string', 'created_at' => 'timestamp', 'delivery_charge' => 'float', 'driver_id' => 'int', 'invoice_no' => 'string', 'net_amount' => 'float', 'offer_amount' => 'float', 'offer_id' => 'int', 'order_date' => 'date', 'order_id' => 'string', 'other_reason' => 'string', 'otp' => 'string', 'purchase_date' => 'string', 'refund_amount' => 'float', 'reject_driver_id' => 'int', 'shop_id' => 'int', 'taxes' => 'float', 'total_amount' => 'float', 'total_item' => 'int', 'transaction_id' => 'string', 'updated_at' => 'datetime', 'user_id' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'order_date', 'updated_at', 'created_at', 'order_date', 'updated_at'
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
