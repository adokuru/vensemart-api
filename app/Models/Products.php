<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $category_id
 * @property int      $created_at
 * @property int      $quantity
 * @property int      $shop_id
 * @property int      $sub_cat_id
 * @property int      $uom_id
 * @property string   $discount
 * @property string   $product_Description
 * @property string   $product_image
 * @property string   $product_title
 * @property float    $product_price
 * @property DateTime $updated_at
 */
class Products extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
        'category_id', 'created_at', 'discount', 'in_stock', 'product_Description', 'product_image', 'product_price', 'product_title', 'quantity', 'shop_id', 'status', 'sub_cat_id', 'uom_id', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'category_id' => 'int', 'created_at' => 'timestamp', 'discount' => 'string', 'product_Description' => 'string', 'product_image' => 'string', 'product_price' => 'float', 'product_title' => 'string', 'quantity' => 'int', 'shop_id' => 'int', 'sub_cat_id' => 'int', 'uom_id' => 'int', 'updated_at' => 'datetime'
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

    public function shop()
    {
        return $this->belongsTo('App\Models\Stores', 'shop_id');
    }
}
