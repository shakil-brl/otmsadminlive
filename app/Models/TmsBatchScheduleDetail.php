<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsBatchScheduleDetail
 *
 * @property $id
 * @property $batch_schedule_id
 * @property $ConductedProfileId
 * @property $start_time
 * @property $streaming_link
 * @property $static_link
 * @property $end_time
 * @property $date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsBatchScheduleDetail extends Model
{
    
    static $rules = [
		'batch_schedule_id' => 'required',
		'ConductedProfileId' => 'required',
		'start_time' => 'required',
		'end_time' => 'required',
		'date' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batch_schedule_id','ConductedProfileId','start_time','streaming_link','static_link','end_time','date','status'];



}
