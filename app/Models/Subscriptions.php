<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property string   $amount
 * @property string   $name
 * @property string   $validity
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Subscriptions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

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
        'amount', 'created_at', 'name', 'updated_at', 'validity'
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
        'id' => 'int', 'amount' => 'string', 'created_at' => 'datetime', 'name' => 'string', 'updated_at' => 'datetime', 'validity' => 'string'
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
