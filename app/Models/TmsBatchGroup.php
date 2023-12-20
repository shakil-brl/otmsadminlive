<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsBatchGroup
 *
 * @property $id
 * @property $name_bn
 * @property $name_en
 * @property $code
 * @property $remark
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsBatchGroup extends Model
{
  protected $table = "tms_batch_group";
  static $rules = [
    'name_bn' => 'required',
    'name_en' => 'required',
    'code' => 'required',
    'remark' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['name_bn', 'name_en', 'code', 'remark'];



}
