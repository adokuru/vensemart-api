<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property Date   $date
 * @property string $description
 * @property string $image
 * @property string $name
 * @property string $price_id
 * @property string $slug
 */
class LiveSessions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'live_sessions';

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
        'created_at', 'date', 'description', 'image', 'industries_id', 'name', 'price', 'price_id', 'slug', 'status', 'time', 'updated_at', 'user_id'
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
        'created_at' => 'timestamp', 'date' => 'date', 'description' => 'string', 'image' => 'string', 'name' => 'string', 'price_id' => 'string', 'slug' => 'string', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'date', 'updated_at'
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
