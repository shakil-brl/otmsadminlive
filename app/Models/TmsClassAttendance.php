<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsClassAttendance
 *
 * @property $id
 * @property $batch_schedule_detail_id
 * @property $ProfileId
 * @property $is_present
 * @property $joining_time
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsClassAttendance extends Model
{
    
    static $rules = [
		'batch_schedule_detail_id' => 'required',
		'joining_time' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batch_schedule_detail_id','ProfileId','is_present','joining_time'];



}
