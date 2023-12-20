<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsProvidersTrainer
 *
 * @property $id
 * @property $provider_id
 * @property $batch_id
 * @property $ProfileId
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsProvidersTrainer extends Model
{
    
    static $rules = [
		'provider_id' => 'required',
		'batch_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['provider_id','batch_id','ProfileId'];



}
