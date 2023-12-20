<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingTitle
 *
 * @property $id
 * @property $Name
 * @property $NameEn
 * @property $TrainingAreaId
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrainingTitle extends Model
{
    
    static $rules = [
		'Name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Name','NameEn','TrainingAreaId'];



}
