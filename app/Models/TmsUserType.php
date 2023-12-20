<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsUserType
 *
 * @property $id
 * @property $role_id
 * @property $ProfileId
 * @property $district_id
 * @property $upazila_id
 * @property $provider_id
 * @property $created_user_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsUserType extends Model
{
    
    static $rules = [
		'role_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id','ProfileId','district_id','upazila_id','provider_id','created_user_id'];



}
