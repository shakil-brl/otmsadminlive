<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DevelopmentPartnerEmpoly
 *
 * @property $id
 * @property $profile_id
 * @property $development_partner_id
 * @property $joining_date
 * @property $training_batch_id_list
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DevelopmentPartnerEmpoly extends Model
{
  protected $table = 'development_partner_empolys';
  static $rules = [
    'profile_id' => 'required',
    'development_partner_id' => 'required',
    'joining_date' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['profile_id', 'development_partner_id', 'joining_date', 'training_batch_id_list'];



}
