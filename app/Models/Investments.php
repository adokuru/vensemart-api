<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $custodian
 * @property string $description
 * @property string $name
 * @property string $registrar
 * @property string $trustee
 */
class Investments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'investments';

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
        'created_at', 'custodian', 'description', 'management_fee', 'min_amount', 'name', 'registrar', 'returns', 'risk', 'roi', 'status', 'trustee', 'updated_at'
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
        'created_at' => 'timestamp', 'custodian' => 'string', 'description' => 'string', 'name' => 'string', 'registrar' => 'string', 'trustee' => 'string', 'updated_at' => 'timestamp'
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
