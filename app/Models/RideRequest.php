<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;

    protected $fillable = ['start_latitude', 'start_longitude', 'end_latitude', 'start_address', 'end_longitude', 'end_address', 'distance', 'duration', 'reason', 'base_distance', 'cancel_by', 'otp', 'is_ride_for_other', 'other_rider_data'];


    protected $casts = [

        'other_rider_data' => 'array'

    ];


    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function getOtherRiderDataAttribute($value)
    {
        return isset($value) ? json_decode($value, true) : null;
    }

    public function setOtherRiderDataAttribute($value)
    {
        $this->attributes['other_rider_data'] = isset($value) ? json_encode($value) : null;
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'ride_request_id', 'id');
    }
}
