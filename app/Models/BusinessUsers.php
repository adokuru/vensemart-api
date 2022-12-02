<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $email_verified_at
 * @property int    $updated_at
 * @property string $email
 * @property string $manager_name
 * @property string $password
 * @property string $phone_number
 * @property string $verify_code
 */
class BusinessUsers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_users';

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
        'business_id', 'created_at', 'email', 'email_verified_at', 'level', 'manager_name', 'password', 'phone_number', 'status', 'updated_at', 'verify_code'
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
        'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'manager_name' => 'string', 'password' => 'string', 'phone_number' => 'string', 'updated_at' => 'timestamp', 'verify_code' => 'string'
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
