<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsProvider
 *
 * @property $id
 * @property $name
 * @property $mobile
 * @property $email
 * @property $web_url
 * @property $address
 * @property $created_user_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsProvider extends Model
{
    
    static $rules = [
		'name' => 'required',
		'mobile' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','mobile','email','web_url','address','created_user_id'];



}
