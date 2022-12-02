<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $assignment_file
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $is_completed
 */
class StudentCourseWeekAssignments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_course_week_assignments';

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
        'assignment_file', 'course_student_id', 'created_at', 'is_completed', 'updated_at', 'week_id'
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
        'assignment_file' => 'string', 'created_at' => 'timestamp', 'is_completed' => 'boolean', 'updated_at' => 'timestamp'
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
