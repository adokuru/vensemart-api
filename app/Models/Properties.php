<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $address
 * @property string $cuddle_document
 * @property string $description
 * @property string $holding_period
 * @property string $investment_profile
 * @property string $irr
 * @property string $latitude
 * @property string $launch_date
 * @property string $longitude
 * @property string $name
 * @property string $property_deadline
 * @property string $property_status
 * @property string $property_title
 * @property string $slug
 * @property string $youtube_link
 * @property int    $created_at
 * @property int    $deleted_at
 * @property int    $first_year_returns
 * @property int    $five_year_returns
 * @property int    $no_bedroom
 * @property int    $no_investment
 * @property int    $no_sqm
 * @property int    $no_units
 * @property int    $seven_year_returns
 * @property int    $status
 * @property int    $ten_year_returns
 * @property int    $updated_at
 */
class Properties extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';

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
        'address', 'city_id', 'country_id', 'created_at', 'cuddle_document', 'deleted_at', 'description', 'first_year_returns', 'five_year_returns', 'holding_period', 'investment_profile', 'irr', 'latitude', 'launch_date', 'longitude', 'min_investment', 'name', 'no_bedroom', 'no_investment', 'no_sqm', 'no_units', 'price', 'property_deadline', 'property_investment_type_id', 'property_status', 'property_title', 'property_type_id', 'purchased_price', 'seven_year_returns', 'slug', 'state_id', 'status', 'target_rent', 'ten_year_returns', 'updated_at', 'user_id', 'youtube_link'
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
        'address' => 'string', 'created_at' => 'timestamp', 'cuddle_document' => 'string', 'deleted_at' => 'timestamp', 'description' => 'string', 'first_year_returns' => 'int', 'five_year_returns' => 'int', 'holding_period' => 'string', 'investment_profile' => 'string', 'irr' => 'string', 'latitude' => 'string', 'launch_date' => 'string', 'longitude' => 'string', 'name' => 'string', 'no_bedroom' => 'int', 'no_investment' => 'int', 'no_sqm' => 'int', 'no_units' => 'int', 'property_deadline' => 'string', 'property_status' => 'string', 'property_title' => 'string', 'seven_year_returns' => 'int', 'slug' => 'string', 'status' => 'int', 'ten_year_returns' => 'int', 'updated_at' => 'timestamp', 'youtube_link' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'deleted_at', 'updated_at'
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
