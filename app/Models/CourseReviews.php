<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $comment
 * @property int     $course_id
 * @property int     $created_at
 * @property int     $updated_at
 * @property int     $user_id
 * @property float   $star
 * @property boolean $status
 */
class CourseReviews extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_reviews';

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
        'comment', 'course_id', 'created_at', 'star', 'status', 'updated_at', 'user_id'
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
        'comment' => 'string', 'course_id' => 'int', 'created_at' => 'timestamp', 'star' => 'double', 'status' => 'boolean', 'updated_at' => 'timestamp', 'user_id' => 'int'
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
