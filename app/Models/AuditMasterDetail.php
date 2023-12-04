<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditMasterDetail
 *
 * @property $id
 * @property $auditmaster_id
 * @property $audittasks_id
 * @property $remark
 * @property $document
 * @property $created_at
 * @property $Updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AuditMasterDetail extends Model
{

    static $rules = [
        'auditmaster_id' => 'required',
        'audittasks_id' => 'required',
        'remark' => 'required',

    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['auditmaster_id', 'audittasks_id', 'remark', 'document'];



}