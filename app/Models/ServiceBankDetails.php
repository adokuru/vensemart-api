<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $user_id
 * @property string $account_holder_name
 * @property string $account_number
 * @property string $bank_name
 * @property string $branch_address
 * @property string $ifsc_code
 */
class ServiceBankDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_bank_details';

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
        'account_holder_name', 'account_number', 'bank_name', 'branch_address', 'created_at', 'ifsc_code', 'updated_at', 'user_id'
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
        'id' => 'int', 'account_holder_name' => 'string', 'account_number' => 'string', 'bank_name' => 'string', 'branch_address' => 'string', 'created_at' => 'timestamp', 'ifsc_code' => 'string', 'updated_at' => 'timestamp', 'user_id' => 'int'
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
