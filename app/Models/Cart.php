<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $cat_id
 * @property int      $created_at
 * @property int      $product_id
 * @property int      $qty
 * @property int      $uom_id
 * @property int      $user_id
 * @property float    $after_discount_amount
 * @property float    $net_amount
 * @property string   $product_image
 * @property string   $product_name
 * @property DateTime $updated_at
 */
class Cart extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart';

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
        'after_discount_amount', 'cat_id', 'created_at', 'net_amount', 'product_id', 'product_image', 'product_name', 'qty', 'uom_id', 'updated_at', 'user_id'
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
        'id' => 'int', 'after_discount_amount' => 'float', 'cat_id' => 'int', 'created_at' => 'timestamp', 'net_amount' => 'float', 'product_id' => 'int', 'product_image' => 'string', 'product_name' => 'string', 'qty' => 'int', 'uom_id' => 'int', 'updated_at' => 'datetime', 'user_id' => 'int'
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
