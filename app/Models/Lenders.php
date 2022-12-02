<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code
 * @property string $company_address
 * @property string $company_city
 * @property string $company_email
 * @property string $company_name
 * @property string $company_phone
 * @property string $company_state
 * @property string $company_zip
 * @property string $contact_person_first_name
 * @property string $contact_person_last_name
 * @property int    $created_at
 * @property int    $status
 * @property int    $updated_at
 */
class Lenders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lenders';

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
        'code', 'company_address', 'company_city', 'company_email', 'company_name', 'company_phone', 'company_state', 'company_zip', 'contact_person_first_name', 'contact_person_last_name', 'country_id', 'created_at', 'status', 'updated_at'
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
        'code' => 'string', 'company_address' => 'string', 'company_city' => 'string', 'company_email' => 'string', 'company_name' => 'string', 'company_phone' => 'string', 'company_state' => 'string', 'company_zip' => 'string', 'contact_person_first_name' => 'string', 'contact_person_last_name' => 'string', 'created_at' => 'timestamp', 'status' => 'int', 'updated_at' => 'timestamp'
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
