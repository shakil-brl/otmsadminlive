<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsEvaluationForTrainer
 *
 * @property $id
 * @property $trainer_id
 * @property $batch_id
 * @property $student_id
 * @property $rating
 * @property $review
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsEvaluationForTrainer extends Model
{
    
    static $rules = [
		'trainer_id' => 'required',
		'batch_id' => 'required',
		'student_id' => 'required',
		'rating' => 'required',
		'review' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['trainer_id','batch_id','student_id','rating','review'];



}
