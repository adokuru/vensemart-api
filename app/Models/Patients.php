<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $age
 * @property string $country
 * @property string $designation
 * @property string $dob
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $phone_number
 * @property string $religon
 * @property string $secondary_phone_number
 * @property string $state
 * @property string $tribe
 * @property int    $created_at
 * @property int    $gender
 * @property int    $handedness
 * @property int    $martial_status
 * @property int    $updated_at
 */
class Patients extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patients';

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
        'address', 'age', 'country', 'created_at', 'designation', 'dob', 'email', 'first_name', 'gender', 'handedness', 'last_name', 'martial_status', 'password', 'phone_number', 'religon', 'secondary_phone_number', 'state', 'tribe', 'updated_at'
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
        'address' => 'string', 'age' => 'string', 'country' => 'string', 'created_at' => 'timestamp', 'designation' => 'string', 'dob' => 'string', 'email' => 'string', 'first_name' => 'string', 'gender' => 'int', 'handedness' => 'int', 'last_name' => 'string', 'martial_status' => 'int', 'password' => 'string', 'phone_number' => 'string', 'religon' => 'string', 'secondary_phone_number' => 'string', 'state' => 'string', 'tribe' => 'string', 'updated_at' => 'timestamp'
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
