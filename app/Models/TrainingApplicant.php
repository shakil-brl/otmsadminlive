<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingApplicant
 *
 * @property $id
 * @property $ProfileId
 * @property $TrainingTitleId
 * @property $BatchId
 * @property $ApplicationDate
 * @property $Marks
 * @property $IsSelected
 * @property $IsRejected
 * @property $IsTrainee
 * @property $isDroppedOut
 * @property $droppedOutReason
 * @property $droppedOutByProfileId
 * @property $droppedOutDate
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrainingApplicant extends Model
{
    
    static $rules = [
		'Marks' => 'required',
		'IsTrainee' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ProfileId','TrainingTitleId','BatchId','ApplicationDate','Marks','IsSelected','IsRejected','IsTrainee','isDroppedOut','droppedOutReason','droppedOutByProfileId','droppedOutDate'];



}
