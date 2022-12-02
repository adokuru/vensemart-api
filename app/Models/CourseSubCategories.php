<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $course_category_id
 * @property int     $created_at
 * @property int     $position_order
 * @property int     $updated_at
 * @property int     $created_at
 * @property int     $updated_at
 * @property string  $image
 * @property string  $name
 * @property string  $name
 * @property string  $slug
 * @property boolean $show_home
 * @property boolean $status
 */
class CourseSubCategories extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_sub_categories';

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
        'course_category_id', 'created_at', 'image', 'name', 'position_order', 'show_home', 'status', 'updated_at', 'course_category_id', 'created_at', 'name', 'slug', 'updated_at'
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
        'course_category_id' => 'int', 'created_at' => 'timestamp', 'image' => 'string', 'name' => 'string', 'position_order' => 'int', 'show_home' => 'boolean', 'status' => 'boolean', 'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'name' => 'string', 'slug' => 'string', 'updated_at' => 'timestamp'
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
