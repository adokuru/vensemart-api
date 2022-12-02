<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $date
 * @property string $dropoff_location
 * @property string $from
 * @property string $invoice_number
 * @property string $logo
 * @property string $orders
 * @property string $payment_method
 * @property string $pickup_location
 * @property string $status
 * @property string $to
 */
class Invoices extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

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
        'business_id', 'created_at', 'date', 'dropoff_location', 'from', 'invoice_number', 'logo', 'orders', 'payment_method', 'pickup_location', 'status', 'to', 'updated_at'
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
        'created_at' => 'timestamp', 'date' => 'string', 'dropoff_location' => 'string', 'from' => 'string', 'invoice_number' => 'string', 'logo' => 'string', 'orders' => 'string', 'payment_method' => 'string', 'pickup_location' => 'string', 'status' => 'string', 'to' => 'string', 'updated_at' => 'timestamp'
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
