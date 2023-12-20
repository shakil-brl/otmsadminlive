<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsRoleHasPermission
 *
 * @property $permission_id
 * @property $role_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsRoleHasPermission extends Model
{
    
    static $rules = [
		'permission_id' => 'required',
		'role_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id','role_id'];



}
