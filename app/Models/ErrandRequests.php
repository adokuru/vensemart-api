<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $additional_address
 * @property string $amount_paid
 * @property string $customer_id
 * @property string $errand_type
 * @property string $fifth_stop_delivery_address
 * @property string $fifth_stop_delivery_contact_name
 * @property string $fifth_stop_delivery_contact_number
 * @property string $fifth_stop_description
 * @property string $fifth_stop_pickup_address
 * @property string $fifth_stop_pickup_contact_name
 * @property string $fifth_stop_pickup_contact_number
 * @property string $first_stop_delivery_address
 * @property string $first_stop_delivery_contact_name
 * @property string $first_stop_delivery_contact_number
 * @property string $first_stop_description
 * @property string $first_stop_pickup_address
 * @property string $first_stop_pickup_contact_name
 * @property string $first_stop_pickup_contact_number
 * @property string $forth_stop_delivery_address
 * @property string $forth_stop_delivery_contact_name
 * @property string $forth_stop_delivery_contact_number
 * @property string $forth_stop_description
 * @property string $forth_stop_pickup_address
 * @property string $forth_stop_pickup_contact_name
 * @property string $forth_stop_pickup_contact_number
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
 * @property string $second_stop_delivery_address
 * @property string $second_stop_delivery_contact_name
 * @property string $second_stop_delivery_contact_number
 * @property string $second_stop_description
 * @property string $second_stop_pickup_address
 * @property string $second_stop_pickup_contact_name
 * @property string $second_stop_pickup_contact_number
 * @property string $third_stop_delivery_address
 * @property string $third_stop_delivery_contact_name
 * @property string $third_stop_delivery_contact_number
 * @property string $third_stop_description
 * @property string $third_stop_pickup_address
 * @property string $third_stop_pickup_contact_name
 * @property string $third_stop_pickup_contact_number
 * @property string $tracking_number
 * @property string $value_of_item
 * @property string $vehicle_type
 * @property int    $created_at
 * @property int    $updated_at
 */
class ErrandRequests extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'errand_requests';

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
        'accepted_by', 'additional_address', 'amount_paid', 'assigned_to', 'created_at', 'customer_id', 'errand_type', 'fifth_stop_delivery_address', 'fifth_stop_delivery_contact_name', 'fifth_stop_delivery_contact_number', 'fifth_stop_description', 'fifth_stop_pickup_address', 'fifth_stop_pickup_contact_name', 'fifth_stop_pickup_contact_number', 'first_stop_delivery_address', 'first_stop_delivery_contact_name', 'first_stop_delivery_contact_number', 'first_stop_description', 'first_stop_pickup_address', 'first_stop_pickup_contact_name', 'first_stop_pickup_contact_number', 'forth_stop_delivery_address', 'forth_stop_delivery_contact_name', 'forth_stop_delivery_contact_number', 'forth_stop_description', 'forth_stop_pickup_address', 'forth_stop_pickup_contact_name', 'forth_stop_pickup_contact_number', 'frequency', 'insurance', 'is_paid', 'number_of_item', 'package_category', 'package_image', 'package_image2', 'package_image3', 'package_image4', 'package_image5', 'package_weight', 'payment_method', 'schedule', 'second_stop_delivery_address', 'second_stop_delivery_contact_name', 'second_stop_delivery_contact_number', 'second_stop_description', 'second_stop_pickup_address', 'second_stop_pickup_contact_name', 'second_stop_pickup_contact_number', 'status', 'third_stop_delivery_address', 'third_stop_delivery_contact_name', 'third_stop_delivery_contact_number', 'third_stop_description', 'third_stop_pickup_address', 'third_stop_pickup_contact_name', 'third_stop_pickup_contact_number', 'tracking_number', 'updated_at', 'value_of_item', 'vehicle_type'
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
        'additional_address' => 'string', 'amount_paid' => 'string', 'created_at' => 'timestamp', 'customer_id' => 'string', 'errand_type' => 'string', 'fifth_stop_delivery_address' => 'string', 'fifth_stop_delivery_contact_name' => 'string', 'fifth_stop_delivery_contact_number' => 'string', 'fifth_stop_description' => 'string', 'fifth_stop_pickup_address' => 'string', 'fifth_stop_pickup_contact_name' => 'string', 'fifth_stop_pickup_contact_number' => 'string', 'first_stop_delivery_address' => 'string', 'first_stop_delivery_contact_name' => 'string', 'first_stop_delivery_contact_number' => 'string', 'first_stop_description' => 'string', 'first_stop_pickup_address' => 'string', 'first_stop_pickup_contact_name' => 'string', 'first_stop_pickup_contact_number' => 'string', 'forth_stop_delivery_address' => 'string', 'forth_stop_delivery_contact_name' => 'string', 'forth_stop_delivery_contact_number' => 'string', 'forth_stop_description' => 'string', 'forth_stop_pickup_address' => 'string', 'forth_stop_pickup_contact_name' => 'string', 'forth_stop_pickup_contact_number' => 'string', 'frequency' => 'string', 'insurance' => 'string', 'number_of_item' => 'string', 'package_category' => 'string', 'package_image' => 'string', 'package_image2' => 'string', 'package_image3' => 'string', 'package_image4' => 'string', 'package_image5' => 'string', 'package_weight' => 'string', 'second_stop_delivery_address' => 'string', 'second_stop_delivery_contact_name' => 'string', 'second_stop_delivery_contact_number' => 'string', 'second_stop_description' => 'string', 'second_stop_pickup_address' => 'string', 'second_stop_pickup_contact_name' => 'string', 'second_stop_pickup_contact_number' => 'string', 'third_stop_delivery_address' => 'string', 'third_stop_delivery_contact_name' => 'string', 'third_stop_delivery_contact_number' => 'string', 'third_stop_description' => 'string', 'third_stop_pickup_address' => 'string', 'third_stop_pickup_contact_name' => 'string', 'third_stop_pickup_contact_number' => 'string', 'tracking_number' => 'string', 'updated_at' => 'timestamp', 'value_of_item' => 'string', 'vehicle_type' => 'string'
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
