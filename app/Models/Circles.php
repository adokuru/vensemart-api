<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string   $circle_theme_id
 * @property string   $description
 * @property string   $name
 * @property int      $created_at
 * @property int      $target_duration
 * @property int      $updated_at
 * @property DateTime $end_date
 * @property boolean  $is_permission_required
 * @property boolean  $is_private
 */
class Circles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'circles';

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
        'circle_category_id', 'circle_theme_id', 'contribution_frequency', 'created_at', 'currency', 'description', 'end_date', 'is_permission_required', 'is_private', 'minimum_contribution', 'name', 'owner_id', 'roi', 'target', 'target_duration', 'target_percentage', 'type', 'updated_at'
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
        'circle_theme_id' => 'string', 'created_at' => 'timestamp', 'description' => 'string', 'end_date' => 'datetime', 'is_permission_required' => 'boolean', 'is_private' => 'boolean', 'name' => 'string', 'target_duration' => 'int', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'end_date', 'updated_at'
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
