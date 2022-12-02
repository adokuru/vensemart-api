<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $content
 * @property string $slug
 * @property string $title
 * @property int    $created_at
 * @property int    $deleted_at
 * @property int    $status
 * @property int    $updated_at
 * @property int    $view_count
 */
class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

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
        'category_id', 'content', 'created_at', 'deleted_at', 'slug', 'status', 'title', 'updated_at', 'user_id', 'view_count'
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
        'content' => 'string', 'created_at' => 'timestamp', 'deleted_at' => 'timestamp', 'slug' => 'string', 'status' => 'int', 'title' => 'string', 'updated_at' => 'timestamp', 'view_count' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'deleted_at', 'updated_at'
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
