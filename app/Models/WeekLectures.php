<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $description
 * @property string $video
 * @property string $video_duration
 * @property string $video_order
 * @property string $video_size
 * @property string $video_status
 * @property string $video_type
 */
class WeekLectures extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'week_lectures';

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
        'course_week_id', 'created_at', 'description', 'updated_at', 'video', 'video_duration', 'video_order', 'video_size', 'video_status', 'video_type'
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
        'created_at' => 'timestamp', 'description' => 'string', 'updated_at' => 'timestamp', 'video' => 'string', 'video_duration' => 'string', 'video_order' => 'string', 'video_size' => 'string', 'video_status' => 'string', 'video_type' => 'string'
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
