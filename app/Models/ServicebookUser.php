<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 * @property string $booking_date
 * @property string $booking_id
 * @property string $booking_time
 * @property string $cancel_reason
 * @property string $description
 * @property string $mobile_number
 * @property string $payment_mode
 * @property string $payment_status
 * @property string $price
 * @property string $service_pro_id
 * @property string $service_type
 * @property string $transaction_id
 * @property string $user_address
 * @property string $user_id
 * @property string $user_lat
 * @property string $user_long
 */
class ServicebookUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicebook_user';

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
        'booking_date', 'booking_id', 'booking_time', 'cancel_reason', 'created_at', 'description', 'mobile_number', 'payment_mode', 'payment_status', 'price', 'service_pro_id', 'service_type', 'status', 'transaction_id', 'updated_at', 'user_address', 'user_id', 'user_lat', 'user_long'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'booking_date' => 'string', 'booking_id' => 'string', 'booking_time' => 'string', 'cancel_reason' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'mobile_number' => 'string', 'payment_mode' => 'string', 'payment_status' => 'string', 'price' => 'string', 'service_pro_id' => 'string', 'service_type' => 'string', 'status' => 'int', 'transaction_id' => 'string', 'updated_at' => 'timestamp', 'user_address' => 'string', 'user_id' => 'string', 'user_lat' => 'string', 'user_long' => 'string'
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

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}
