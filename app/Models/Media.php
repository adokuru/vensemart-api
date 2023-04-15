<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $collection_name
 * @property string $conversions_disk
 * @property string $disk
 * @property string $file_name
 * @property string $mime_type
 * @property string $model_type
 * @property string $name
 * @property string $collection_name
 * @property string $conversions_disk
 * @property string $disk
 * @property string $file_name
 * @property string $mime_type
 * @property string $model_type
 * @property string $name
 * @property int    $created_at
 * @property int    $order_column
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $order_column
 * @property int    $updated_at
 */
class Media extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';

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
        'collection_name', 'conversions_disk', 'created_at', 'custom_properties', 'disk', 'file_name', 'generated_conversions', 'manipulations', 'mime_type', 'model_id', 'model_type', 'name', 'order_column', 'responsive_images', 'size', 'updated_at', 'uuid', 'collection_name', 'conversions_disk', 'created_at', 'custom_properties', 'disk', 'file_name', 'generated_conversions', 'manipulations', 'mime_type', 'model_id', 'model_type', 'name', 'order_column', 'responsive_images', 'size', 'updated_at', 'uuid'
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
        'collection_name' => 'string', 'conversions_disk' => 'string', 'created_at' => 'timestamp', 'disk' => 'string', 'file_name' => 'string', 'mime_type' => 'string', 'model_type' => 'string', 'name' => 'string', 'order_column' => 'int', 'updated_at' => 'timestamp', 'collection_name' => 'string', 'conversions_disk' => 'string', 'created_at' => 'timestamp', 'disk' => 'string', 'file_name' => 'string', 'mime_type' => 'string', 'model_type' => 'string', 'name' => 'string', 'order_column' => 'int', 'updated_at' => 'timestamp'
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
