<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $currency
 * @property string $description
 * @property string $image
 * @property string $name
 * @property string $price
 * @property string $status
 * @property string $business_name
 * @property string $email
 * @property string $fullName
 * @property string $industry
 * @property string $message
 * @property string $phone
 * @property string $website_url
 */
class Tickets extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';

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
        'company_id', 'created_at', 'currency', 'description', 'image', 'name', 'price', 'status', 'ticket_type_id', 'updated_at', 'vendor_id', 'business_name', 'created_at', 'email', 'fullName', 'industry', 'message', 'phone', 'status', 'updated_at', 'website_url'
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
        'created_at' => 'timestamp', 'currency' => 'string', 'description' => 'string', 'image' => 'string', 'name' => 'string', 'price' => 'string', 'status' => 'string', 'updated_at' => 'timestamp', 'business_name' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'fullName' => 'string', 'industry' => 'string', 'message' => 'string', 'phone' => 'string', 'updated_at' => 'timestamp', 'website_url' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at'
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
