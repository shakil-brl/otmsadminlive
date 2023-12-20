<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsTrainingBatchSchedule
 *
 * @property $id
 * @property $training_id
 * @property $training_batch_id
 * @property $provider_id
 * @property $class_days
 * @property $class_time
 * @property $class_duration
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsTrainingBatchSchedule extends Model
{
    
    static $rules = [
		'training_id' => 'required',
		'training_batch_id' => 'required',
		'provider_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['training_id','training_batch_id','provider_id','class_days','class_time','class_duration'];



}
