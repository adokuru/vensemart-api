<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean  $can_customer_resubmit_kyc
 * @property boolean  $has_paid_first_installment
 * @property boolean  $is_offer_accepted
 * @property int      $created_at
 * @property int      $maximum_tenor_allowed_for_repayment
 * @property int      $status
 * @property int      $updated_at
 * @property DateTime $date_kyc_status_updated
 * @property DateTime $date_offer_was_accepted
 * @property string   $reason_kyc_was_rejected
 */
class CustomerOrderToLenders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_order_to_lenders';

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
        'can_customer_resubmit_kyc', 'created_at', 'customer_id', 'date_kyc_status_updated', 'date_offer_was_accepted', 'has_paid_first_installment', 'interest_amount', 'interest_rate', 'is_offer_accepted', 'kyc_status', 'kyc_status_updated_by', 'lender_id', 'maximum_tenor_allowed_for_repayment', 'order_id', 'reason_kyc_was_rejected', 'status', 'updated_at'
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
        'can_customer_resubmit_kyc' => 'boolean', 'created_at' => 'timestamp', 'date_kyc_status_updated' => 'datetime', 'date_offer_was_accepted' => 'datetime', 'has_paid_first_installment' => 'boolean', 'is_offer_accepted' => 'boolean', 'maximum_tenor_allowed_for_repayment' => 'int', 'reason_kyc_was_rejected' => 'string', 'status' => 'int', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'date_kyc_status_updated', 'date_offer_was_accepted', 'updated_at'
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
