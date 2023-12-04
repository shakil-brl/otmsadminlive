<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditMaster
 *
 * @property $id
 * @property $user_id
 * @property $batche_id
 * @property $status
 * @property $created_at
 * @property $Updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AuditMaster extends Model
{

    static $rules = [
        'user_id' => 'required',
        'batche_id' => 'required',
        'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'batche_id', 'status'];



}