<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $bio
 * @property string $career
 * @property string $email
 * @property string $image_url
 * @property string $name
 * @property string $phone
 * @property int    $created_at
 * @property int    $updated_at
 */
class Instructors extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'instructors';

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
        'bio', 'career', 'created_at', 'email', 'image_url', 'name', 'phone', 'updated_at'
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
        'bio' => 'string', 'career' => 'string', 'created_at' => 'timestamp', 'email' => 'string', 'image_url' => 'string', 'name' => 'string', 'phone' => 'string', 'updated_at' => 'timestamp'
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
