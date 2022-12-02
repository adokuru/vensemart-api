<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $allergies
 * @property string $blood_group
 * @property string $genotype
 * @property string $height
 * @property string $managing_ailment
 * @property string $specify_surgery_type
 * @property string $taking_medications
 * @property string $weight
 * @property int    $created_at
 * @property int    $prior_surgery
 * @property int    $updated_at
 */
class PatientMedicalInfos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_medical_infos';

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
        'allergies', 'blood_group', 'created_at', 'genotype', 'height', 'managing_ailment', 'patients_id', 'prior_surgery', 'specify_surgery_type', 'taking_medications', 'updated_at', 'weight'
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
        'allergies' => 'string', 'blood_group' => 'string', 'created_at' => 'timestamp', 'genotype' => 'string', 'height' => 'string', 'managing_ailment' => 'string', 'prior_surgery' => 'int', 'specify_surgery_type' => 'string', 'taking_medications' => 'string', 'updated_at' => 'timestamp', 'weight' => 'string'
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
