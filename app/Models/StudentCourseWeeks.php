<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $is_assignment_completed
 * @property boolean $is_completed
 * @property boolean $is_lecture_completed
 * @property boolean $is_quiz_completed
 */
class StudentCourseWeeks extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_course_weeks';

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
        'course_student_id', 'created_at', 'is_assignment_completed', 'is_completed', 'is_lecture_completed', 'is_quiz_completed', 'updated_at', 'week_id'
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
        'created_at' => 'timestamp', 'is_assignment_completed' => 'boolean', 'is_completed' => 'boolean', 'is_lecture_completed' => 'boolean', 'is_quiz_completed' => 'boolean', 'updated_at' => 'timestamp'
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
