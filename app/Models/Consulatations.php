<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $additional_notes
 * @property string  $Circulatory_details
 * @property string  $condition
 * @property string  $Dental_details
 * @property string  $Diagnosis
 * @property string  $GIT_details
 * @property string  $Integumentary_rashes_details
 * @property string  $Musculoskeletal_details
 * @property string  $Neurovascular_details
 * @property string  $Nutrition_details
 * @property string  $prescription
 * @property string  $Psychosocial_details
 * @property string  $Respiratory_details
 * @property string  $Sensory_details
 * @property string  $test
 * @property string  $test_result
 * @property boolean $Circulatory
 * @property boolean $Dental
 * @property boolean $GIT
 * @property boolean $Integumentary_rashes
 * @property boolean $Musculoskeletal
 * @property boolean $Neurovascular
 * @property boolean $Nutrition
 * @property boolean $Psychosocial
 * @property boolean $Respiratory
 * @property boolean $Sensory
 * @property int     $created_at
 * @property int     $updated_at
 */
class Consulatations extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consulatations';

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
        'additional_notes', 'Circulatory', 'Circulatory_details', 'condition', 'created_at', 'Dental', 'Dental_details', 'Diagnosis', 'doctor_id', 'GIT', 'GIT_details', 'Integumentary_rashes', 'Integumentary_rashes_details', 'Musculoskeletal', 'Musculoskeletal_details', 'Neurovascular', 'Neurovascular_details', 'Nutrition', 'Nutrition_details', 'patients_id', 'prescription', 'Psychosocial', 'Psychosocial_details', 'Respiratory', 'Respiratory_details', 'Sensory', 'Sensory_details', 'test', 'test_result', 'updated_at'
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
        'additional_notes' => 'string', 'Circulatory' => 'boolean', 'Circulatory_details' => 'string', 'condition' => 'string', 'created_at' => 'timestamp', 'Dental' => 'boolean', 'Dental_details' => 'string', 'Diagnosis' => 'string', 'GIT' => 'boolean', 'GIT_details' => 'string', 'Integumentary_rashes' => 'boolean', 'Integumentary_rashes_details' => 'string', 'Musculoskeletal' => 'boolean', 'Musculoskeletal_details' => 'string', 'Neurovascular' => 'boolean', 'Neurovascular_details' => 'string', 'Nutrition' => 'boolean', 'Nutrition_details' => 'string', 'prescription' => 'string', 'Psychosocial' => 'boolean', 'Psychosocial_details' => 'string', 'Respiratory' => 'boolean', 'Respiratory_details' => 'string', 'Sensory' => 'boolean', 'Sensory_details' => 'string', 'test' => 'string', 'test_result' => 'string', 'updated_at' => 'timestamp'
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
