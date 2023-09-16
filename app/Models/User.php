<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'email',
        'country_code',
        'mobile',
        'password',
        'otp',
        'profile',
        'device_id',
        'device_type',
        'device_name',
        'device_token',
        'api_token',
        'status',
        'service_type',
        'year_expreance',
        'location',
        'location_lat',
        'location_long',
        'id_prof',
        'what_app',
        'sms',
        'notification',
        'guarantor_name',
        'guarantor_email',
        'guarantor_phone_number',
        'guarantor_address',
        'service_discription',
        'service_type_price',
        'state',
        'town',
        'age',
        'gender',
        'referred_by_id',
         'referral_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function referredBy()
    {
    return $this->belongsTo(User::class, 'referred_by_id', 'id');
    }


   public function referrals()
   {
    return $this->hasMany(User::class, 'referred_by_id', 'id');
    }

    public function servicebookUsers()
{
    return $this->hasMany(ServicebookUser::class, 'user_id', 'id');
}


}
