<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $bio
 * @property string  $facebook
 * @property string  $instagram
 * @property string  $linkedin
 * @property string  $telegram
 * @property string  $twitter
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $is_circle_information_visible
 * @property boolean $is_direct_message_visible
 * @property boolean $is_profile_search
 */
class UserInformation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_information';

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
        'bio', 'created_at', 'facebook', 'instagram', 'is_circle_information_visible', 'is_direct_message_visible', 'is_profile_search', 'linkedin', 'telegram', 'twitter', 'updated_at', 'user_id'
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
        'bio' => 'string', 'created_at' => 'timestamp', 'facebook' => 'string', 'instagram' => 'string', 'is_circle_information_visible' => 'boolean', 'is_direct_message_visible' => 'boolean', 'is_profile_search' => 'boolean', 'linkedin' => 'string', 'telegram' => 'string', 'twitter' => 'string', 'updated_at' => 'timestamp'
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
