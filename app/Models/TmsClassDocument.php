<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsClassDocument
 *
 * @property $id
 * @property $tms_batch_schedule_detail_id
 * @property $document_title
 * @property $description
 * @property $document_path
 * @property $tms_course_id
 * @property $doc_type
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsClassDocument extends Model
{

  protected $table = 'tms_class_document';

  static $rules = [
    'tms_batch_schedule_detail_id' => 'required',
    'description' => 'required',
    'document_path' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['tms_batch_schedule_detail_id', 'document_title', 'description', 'document_path', 'tms_course_id', 'doc_type'];



}
