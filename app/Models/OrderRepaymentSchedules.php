<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $created_at
 * @property int      $updated_at
 * @property DateTime $due_date
 * @property DateTime $payment_date
 */
class OrderRepaymentSchedules extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_repayment_schedules';

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
        'amount_paid', 'amount_payable', 'created_at', 'due_date', 'order_id', 'payment_date', 'updated_at'
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
        'created_at' => 'timestamp', 'due_date' => 'datetime', 'payment_date' => 'datetime', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'due_date', 'payment_date', 'updated_at'
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
