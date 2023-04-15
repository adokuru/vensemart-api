<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $default_pick_location
 * @property string $email
 * @property string $employment_date
 * @property string $first_name
 * @property string $gender
 * @property string $id_card
 * @property string $land_mark
 * @property string $last_name
 * @property string $lga
 * @property string $nok_address
 * @property string $nok_email
 * @property string $nok_full_name
 * @property string $nok_phone_number
 * @property string $nok_relationship
 * @property string $other_name
 * @property string $phone_number
 * @property string $profile_photo
 * @property string $remember_token
 * @property string $transaction_pin
 * @property string $utility_bill
 * @property string $vehicle_type
 * @property int    $created_at
 * @property int    $email_verified_at
 * @property int    $rating
 * @property int    $updated_at
 */
class Agents extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agents';

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
        'address', 'business_id', 'created_at', 'default_pick_location', 'email', 'email_verified_at', 'employment_date', 'first_name', 'gender', 'id_card', 'land_mark', 'last_name', 'lga', 'nok_address', 'nok_email', 'nok_full_name', 'nok_phone_number', 'nok_relationship', 'other_name', 'phone_number', 'profile_photo', 'rating', 'remember_token', 'status', 'transaction_pin', 'type', 'updated_at', 'utility_bill', 'vehicle_type', 'work_status'
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
        'address' => 'string', 'created_at' => 'timestamp', 'default_pick_location' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'employment_date' => 'string', 'first_name' => 'string', 'gender' => 'string', 'id_card' => 'string', 'land_mark' => 'string', 'last_name' => 'string', 'lga' => 'string', 'nok_address' => 'string', 'nok_email' => 'string', 'nok_full_name' => 'string', 'nok_phone_number' => 'string', 'nok_relationship' => 'string', 'other_name' => 'string', 'phone_number' => 'string', 'profile_photo' => 'string', 'rating' => 'int', 'remember_token' => 'string', 'transaction_pin' => 'string', 'updated_at' => 'timestamp', 'utility_bill' => 'string', 'vehicle_type' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'email_verified_at', 'updated_at'
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
