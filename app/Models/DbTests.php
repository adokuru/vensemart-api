<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $countryOfResidence
 * @property string $dob
 * @property string $firstname
 * @property string $gender
 * @property string $lgaOfResidence
 * @property string $stateOfResidence
 * @property string $surname
 * @property string $title
 * @property string $town
 * @property int    $created_at
 * @property int    $updated_at
 */
class DbTests extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'db_tests';

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
        'address', 'countryOfResidence', 'created_at', 'dob', 'firstname', 'gender', 'lgaOfResidence', 'stateOfResidence', 'surname', 'title', 'town', 'updated_at'
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
        'address' => 'string', 'countryOfResidence' => 'string', 'created_at' => 'timestamp', 'dob' => 'string', 'firstname' => 'string', 'gender' => 'string', 'lgaOfResidence' => 'string', 'stateOfResidence' => 'string', 'surname' => 'string', 'title' => 'string', 'town' => 'string', 'updated_at' => 'timestamp'
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
