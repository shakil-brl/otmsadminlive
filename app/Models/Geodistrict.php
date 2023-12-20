<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Geodistrict
 *
 * @property $id
 * @property $Code
 * @property $Name
 * @property $NameEng
 * @property $ParentCode
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Geodistrict extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Code','Name','NameEng','ParentCode'];



}
