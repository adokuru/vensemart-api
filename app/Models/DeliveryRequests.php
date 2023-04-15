<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $additional_address
 * @property string $amount_paid
 * @property string $customer_id
 * @property string $delivery_address
 * @property string $delivery_contact_name
 * @property string $delivery_contact_number
 * @property string $delivery_type
 * @property string $description
 * @property string $frequency
 * @property string $insurance
 * @property string $number_of_item
 * @property string $package_category
 * @property string $package_image
 * @property string $package_image2
 * @property string $package_image3
 * @property string $package_image4
 * @property string $package_image5
 * @property string $package_weight
 * @property string $pickup_address
 * @property string $pickup_contact_name
 * @property string $pickup_contact_number
 * @property string $reference_number
 * @property string $security_code
 * @property string $tracking_number
 * @property string $value_of_item
 * @property string $vehicle_type
 * @property int    $created_at
 * @property int    $updated_at
 */
class DeliveryRequests extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'delivery_requests';

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
        'accepted_by', 'additional_address', 'amount_paid', 'assigned_to', 'chosen_agent_id', 'created_at', 'customer_id', 'delivery_address', 'delivery_contact_name', 'delivery_contact_number', 'delivery_type', 'description', 'frequency', 'insurance', 'is_paid', 'number_of_item', 'package_category', 'package_image', 'package_image2', 'package_image3', 'package_image4', 'package_image5', 'package_weight', 'payment_method', 'pickup_address', 'pickup_contact_name', 'pickup_contact_number', 'reference_number', 'schedule', 'security_code', 'status', 'tracking_number', 'updated_at', 'value_of_item', 'vehicle_type'
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
        'additional_address' => 'string', 'amount_paid' => 'string', 'created_at' => 'timestamp', 'customer_id' => 'string', 'delivery_address' => 'string', 'delivery_contact_name' => 'string', 'delivery_contact_number' => 'string', 'delivery_type' => 'string', 'description' => 'string', 'frequency' => 'string', 'insurance' => 'string', 'number_of_item' => 'string', 'package_category' => 'string', 'package_image' => 'string', 'package_image2' => 'string', 'package_image3' => 'string', 'package_image4' => 'string', 'package_image5' => 'string', 'package_weight' => 'string', 'pickup_address' => 'string', 'pickup_contact_name' => 'string', 'pickup_contact_number' => 'string', 'reference_number' => 'string', 'security_code' => 'string', 'tracking_number' => 'string', 'updated_at' => 'timestamp', 'value_of_item' => 'string', 'vehicle_type' => 'string'
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
