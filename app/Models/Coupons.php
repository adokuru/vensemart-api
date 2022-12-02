<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $coupon_code
 * @property string   $coupon_description
 * @property string   $coupon_name
 * @property string   $discount
 * @property string   $end_date
 * @property string   $image
 * @property string   $start_date
 * @property string   $status
 * @property string   $user_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Coupons extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

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
        'coupon_code', 'coupon_description', 'coupon_name', 'created_at', 'discount', 'end_date', 'image', 'start_date', 'status', 'updated_at', 'user_id'
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
        'id' => 'int', 'coupon_code' => 'string', 'coupon_description' => 'string', 'coupon_name' => 'string', 'created_at' => 'datetime', 'discount' => 'string', 'end_date' => 'string', 'image' => 'string', 'start_date' => 'string', 'status' => 'string', 'updated_at' => 'datetime', 'user_id' => 'string'
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
