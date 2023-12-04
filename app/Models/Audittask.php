<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Audittask
 *
 * @property $id
 * @property $training_title_id
 * @property $batchCode_id
 * @property $subject
 * @property $instruction
 * @property $status
 * @property $created_at
 * @property $Updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Audittask extends Model
{

    static $rules = [
        'training_title_id' => 'required',
        'subject' => 'required',
        'instruction' => 'required',
        'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['training_title_id', 'batchCode_id', 'subject', 'instruction', 'status'];



}