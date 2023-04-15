<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $user_id
 * @property string   $aadhar_number
 * @property string   $dl_number
 * @property string   $dl_picture
 * @property string   $insurance_number
 * @property string   $insurance_picture
 * @property string   $isVerify
 * @property string   $state
 * @property string   $town
 * @property string   $vehicle_number
 * @property string   $vehicle_type
 * @property DateTime $updated_at
 */
class VehicleDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicle_details';

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
        'aadhar_number', 'created_at', 'dl_number', 'dl_picture', 'insurance_number', 'insurance_picture', 'isVerify', 'state', 'status', 'town', 'updated_at', 'user_id', 'vehicle_number', 'vehicle_type'
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
        'id' => 'int', 'aadhar_number' => 'string', 'created_at' => 'timestamp', 'dl_number' => 'string', 'dl_picture' => 'string', 'insurance_number' => 'string', 'insurance_picture' => 'string', 'isVerify' => 'string', 'state' => 'string', 'town' => 'string', 'updated_at' => 'datetime', 'user_id' => 'int', 'vehicle_number' => 'string', 'vehicle_type' => 'string'
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
