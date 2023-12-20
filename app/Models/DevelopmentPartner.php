<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DevelopmentPartner
 *
 * @property $id
 * @property $name
 * @property $address
 * @property $email
 * @property $phone
 * @property $is_active
 * @property $blocked
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DevelopmentPartner extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','address','email','phone','is_active','blocked'];



}
