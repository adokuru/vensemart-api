<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $created_at
 * @property int      $store_id
 * @property int      $user_id
 * @property string   $comments
 * @property string   $date
 * @property string   $rating
 * @property DateTime $updated_at
 */
class UserFeedback extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_feedback';

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
        'comments', 'created_at', 'date', 'rating', 'store_id', 'updated_at', 'user_id'
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
        'id' => 'int', 'comments' => 'string', 'created_at' => 'timestamp', 'date' => 'string', 'rating' => 'string', 'store_id' => 'int', 'updated_at' => 'datetime', 'user_id' => 'int'
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
