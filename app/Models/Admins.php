<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $email_verified_at
 * @property int      $updated_at
 * @property string   $first_name
 * @property string   $last_name
 * @property string   $email
 * @property string   $mobile_no
 * @property string   $password
 * @property string   $profile_image
 * @property string   $username
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $remember_token
 * @property string   $email
 * @property string   $name
 * @property string   $password
 * @property string   $phone_number
 * @property string   $remember_token
 * @property string   $verify_code
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Admins extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

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
        'created_at', 'first_name', 'last_name', 'updated_at', 'user_id', 'created_at', 'email', 'mobile_no', 'password', 'profile_image', 'updated_at', 'username', 'created_at', 'email', 'name', 'password', 'remember_token', 'updated_at', 'created_at', 'email', 'email_verified_at', 'name', 'password', 'phone_number', 'remember_token', 'status', 'updated_at', 'verify_code'
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
        'id' => 'int', 'created_at' => 'timestamp', 'first_name' => 'string', 'last_name' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'datetime', 'email' => 'string', 'mobile_no' => 'string', 'password' => 'string', 'profile_image' => 'string', 'updated_at' => 'datetime', 'username' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'name' => 'string', 'password' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'email' => 'string', 'email_verified_at' => 'timestamp', 'name' => 'string', 'password' => 'string', 'phone_number' => 'string', 'remember_token' => 'string', 'updated_at' => 'timestamp', 'verify_code' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'updated_at', 'created_at', 'email_verified_at', 'updated_at'
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
