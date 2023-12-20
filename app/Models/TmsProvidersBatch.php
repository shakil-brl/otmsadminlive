<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsProvidersBatch
 *
 * @property $id
 * @property $provider_id
 * @property $batch_ids
 * @property $created_user_id
 * @property $created_at
 * @property $updated_at
 * @property $tms_group_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsProvidersBatch extends Model
{
    
    static $rules = [
		'provider_id' => 'required',
		'batch_ids' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['provider_id','batch_ids','created_user_id','tms_group_id'];



}
