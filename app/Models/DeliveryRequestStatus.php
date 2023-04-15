<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequestStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'driver_id',
        'customer_id',
        'vendor_id',
        'delivery_address',
        'delivery_status',
    ];
}
