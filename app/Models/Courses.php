<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $about
 * @property string  $description
 * @property string  $duration
 * @property string  $host
 * @property string  $image
 * @property string  $language
 * @property string  $level
 * @property string  $link_to_brochure
 * @property string  $meta_description
 * @property string  $meta_keywords
 * @property string  $no_of_projects
 * @property string  $slug
 * @property string  $tagline
 * @property string  $thumbnail
 * @property string  $title
 * @property string  $trailer_link
 * @property string  $video
 * @property string  $description
 * @property string  $discount
 * @property string  $discount_end_date
 * @property string  $discount_price
 * @property string  $discount_start_date
 * @property string  $discount_status
 * @property string  $discount_type
 * @property string  $image
 * @property string  $language
 * @property string  $name
 * @property string  $price
 * @property string  $short_description
 * @property string  $slug
 * @property int     $course_category_id
 * @property int     $course_subcategory_id
 * @property int     $created_at
 * @property int     $total_enrolled
 * @property int     $type
 * @property int     $updated_at
 * @property int     $user_id
 * @property int     $created_at
 * @property int     $status
 * @property int     $updated_at
 * @property float   $discount_price
 * @property float   $price
 * @property float   $reveiw
 * @property float   $reveune
 * @property float   $special_commission
 * @property boolean $publish
 * @property boolean $status
 */
class Courses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
        'about', 'course_category_id', 'course_subcategory_id', 'created_at', 'description', 'discount_price', 'duration', 'host', 'image', 'language', 'level', 'link_to_brochure', 'meta_description', 'meta_keywords', 'no_of_projects', 'price', 'publish', 'reveiw', 'reveune', 'slug', 'special_commission', 'status', 'tagline', 'thumbnail', 'title', 'total_enrolled', 'trailer_link', 'type', 'updated_at', 'user_id', 'video', 'course_category_id', 'course_type_id', 'created_at', 'description', 'discount', 'discount_end_date', 'discount_price', 'discount_start_date', 'discount_status', 'discount_type', 'image', 'industry_id', 'language', 'level', 'name', 'price', 'short_description', 'slug', 'status', 'subcategory_id', 'updated_at', 'user_id'
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
        'about' => 'string', 'course_category_id' => 'int', 'course_subcategory_id' => 'int', 'created_at' => 'timestamp', 'description' => 'string', 'discount_price' => 'double', 'duration' => 'string', 'host' => 'string', 'image' => 'string', 'language' => 'string', 'level' => 'string', 'link_to_brochure' => 'string', 'meta_description' => 'string', 'meta_keywords' => 'string', 'no_of_projects' => 'string', 'price' => 'double', 'publish' => 'boolean', 'reveiw' => 'double', 'reveune' => 'double', 'slug' => 'string', 'special_commission' => 'double', 'status' => 'boolean', 'tagline' => 'string', 'thumbnail' => 'string', 'title' => 'string', 'total_enrolled' => 'int', 'trailer_link' => 'string', 'type' => 'int', 'updated_at' => 'timestamp', 'user_id' => 'int', 'video' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'discount' => 'string', 'discount_end_date' => 'string', 'discount_price' => 'string', 'discount_start_date' => 'string', 'discount_status' => 'string', 'discount_type' => 'string', 'image' => 'string', 'language' => 'string', 'name' => 'string', 'price' => 'string', 'short_description' => 'string', 'slug' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
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
