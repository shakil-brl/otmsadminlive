<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Geodivision
 *
 * @property $id
 * @property $Code
 * @property $Name
 * @property $NameEng
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Geodivision extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Code','Name','NameEng'];



}
