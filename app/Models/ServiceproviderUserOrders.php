<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $booking_date
 * @property string   $booking_id
 * @property string   $booking_time
 * @property string   $cancel_reason
 * @property string   $payment_status
 * @property string   $price
 * @property string   $shop_id
 * @property string   $shop_mobile
 * @property string   $shop_name
 * @property string   $status
 * @property string   $transaction_id
 * @property string   $user_address_id
 * @property string   $user_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class ServiceproviderUserOrders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'serviceprovider_user_orders';

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
        'booking_date', 'booking_id', 'booking_time', 'cancel_reason', 'created_at', 'payment_status', 'price', 'shop_id', 'shop_mobile', 'shop_name', 'status', 'transaction_id', 'updated_at', 'user_address_id', 'user_id'
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
        'id' => 'int', 'booking_date' => 'string', 'booking_id' => 'string', 'booking_time' => 'string', 'cancel_reason' => 'string', 'created_at' => 'datetime', 'payment_status' => 'string', 'price' => 'string', 'shop_id' => 'string', 'shop_mobile' => 'string', 'shop_name' => 'string', 'status' => 'string', 'transaction_id' => 'string', 'updated_at' => 'datetime', 'user_address_id' => 'string', 'user_id' => 'string'
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
