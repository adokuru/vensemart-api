<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $can_customer_resubmit_kyc
 * @property boolean $is_system_rejected
 * @property int     $created_at
 * @property int     $status
 * @property int     $updated_at
 * @property string  $reason_system_rejected
 */
class CustomerKycForLenderApprovals extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_kyc_for_lender_approvals';

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
        'can_customer_resubmit_kyc', 'created_at', 'customer_id', 'is_system_rejected', 'lender_id', 'reason_system_rejected', 'status', 'updated_at'
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
        'can_customer_resubmit_kyc' => 'boolean', 'created_at' => 'timestamp', 'is_system_rejected' => 'boolean', 'reason_system_rejected' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
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
