<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $account_holder_name
 * @property string $account_number
 * @property string $address
 * @property string $bank
 * @property string $branch
 * @property string $city
 * @property string $contact
 * @property string $district
 * @property string $ifsc
 * @property string $micro_code
 * @property string $state
 * @property string $user_id
 */
class BankDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_details';

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
        'account_holder_name', 'account_number', 'address', 'bank', 'branch', 'city', 'contact', 'district', 'ifsc', 'micro_code', 'state', 'user_id'
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
        'id' => 'int', 'account_holder_name' => 'string', 'account_number' => 'string', 'address' => 'string', 'bank' => 'string', 'branch' => 'string', 'city' => 'string', 'contact' => 'string', 'district' => 'string', 'ifsc' => 'string', 'micro_code' => 'string', 'state' => 'string', 'user_id' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        
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
