<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainerProfile
 *
 * @property $id
 * @property $ProfileId
 * @property $professionalBio
 * @property $review
 * @property $rating
 * @property $isActive
 * @property $CreatorProfileId
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrainerProfile extends Model
{
    
    static $rules = [
		'ProfileId' => 'required',
		'professionalBio' => 'required',
		'CreatorProfileId' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ProfileId','professionalBio','review','rating','isActive','CreatorProfileId'];



}
