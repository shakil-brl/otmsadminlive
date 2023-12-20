<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingBatch
 *
 * @property $id
 * @property $batchCode
 * @property $trainingId
 * @property $GEOCode
 * @property $totalTrainees
 * @property $startDate
 * @property $lastApplicationDate
 * @property $provider_id
 * @property $TrainingProviderOrgId
 * @property $GEOLocation
 * @property $TrainingVenue
 * @property $created_at
 * @property $updated_at
 * @property $duration
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrainingBatch extends Model
{
    
    static $rules = [
		'batchCode' => 'required',
		'trainingId' => 'required',
		'GEOCode' => 'required',
		'duration' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batchCode','trainingId','GEOCode','totalTrainees','startDate','lastApplicationDate','provider_id','TrainingProviderOrgId','GEOLocation','TrainingVenue','duration'];



}
