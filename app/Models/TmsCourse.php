<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsCourse
 *
 * @property $id
 * @property $name_bn
 * @property $name_en
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsCourse extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name_bn','name_en'];



}
