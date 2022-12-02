<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $quantity
 * @property int    $updated_at
 * @property string $customer_email
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $note
 * @property string $reference
 * @property string $status
 * @property string $ticket_code
 */
class UserTickets extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_tickets';

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
        'amount', 'created_at', 'customer_email', 'customer_name', 'customer_phone', 'note', 'quantity', 'reference', 'status', 'ticket_code', 'updated_at', 'vendor_id'
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
        'created_at' => 'timestamp', 'customer_email' => 'string', 'customer_name' => 'string', 'customer_phone' => 'string', 'note' => 'string', 'quantity' => 'int', 'reference' => 'string', 'status' => 'string', 'ticket_code' => 'string', 'updated_at' => 'timestamp'
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
