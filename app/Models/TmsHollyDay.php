<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsHollyDay
 *
 * @property $id
 * @property $day_name_en
 * @property $day_name_bn
 * @property $holly_bay
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsHollyDay extends Model
{
    
    static $rules = [
		'day_name_en' => 'required',
		'day_name_bn' => 'required',
		'holly_bay' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['day_name_en','day_name_bn','holly_bay'];



}
