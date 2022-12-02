<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $basic_dp
 * @property string   $dp
 * @property string   $gst
 * @property string   $gst_percent
 * @property string   $invoice_number
 * @property string   $net_price
 * @property string   $order_id
 * @property string   $p_image
 * @property string   $pay_mode
 * @property string   $price
 * @property string   $product_id
 * @property string   $product_name
 * @property string   $purchase_date
 * @property string   $quantity
 * @property string   $seller_id
 * @property string   $tax
 * @property string   $uom_id
 * @property string   $user_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class EshopPurchaseDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'eshop_purchase_detail';

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
        'basic_dp', 'created_at', 'dp', 'gst', 'gst_percent', 'invoice_number', 'net_price', 'order_id', 'p_image', 'pay_mode', 'price', 'product_id', 'product_name', 'purchase_date', 'quantity', 'seller_id', 'tax', 'uom_id', 'updated_at', 'user_id'
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
        'id' => 'int', 'basic_dp' => 'string', 'created_at' => 'datetime', 'dp' => 'string', 'gst' => 'string', 'gst_percent' => 'string', 'invoice_number' => 'string', 'net_price' => 'string', 'order_id' => 'string', 'p_image' => 'string', 'pay_mode' => 'string', 'price' => 'string', 'product_id' => 'string', 'product_name' => 'string', 'purchase_date' => 'string', 'quantity' => 'string', 'seller_id' => 'string', 'tax' => 'string', 'uom_id' => 'string', 'updated_at' => 'datetime', 'user_id' => 'string'
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
