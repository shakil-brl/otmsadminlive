<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsPermission
 *
 * @property $id
 * @property $name
 * @property $route_name
 * @property $guard_name
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsPermission extends Model
{
    
    static $rules = [
		'name' => 'required',
		'guard_name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','route_name','guard_name'];



}
