<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsInspection
 *
 * @property $id
 * @property $batch_id
 * @property $class_no
 * @property $lab_size
 * @property $electricity
 * @property $internet
 * @property $lab_bill
 * @property $lab_attendance
 * @property $computer
 * @property $router
 * @property $projector
 * @property $student_laptop
 * @property $lab_security
 * @property $lab_register
 * @property $class_regularity
 * @property $trainer_attituted
 * @property $trainer_tab_attendance
 * @property $upazila_audit
 * @property $upazila_monitoring
 * @property $remark
 * @property $asset_list
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $Updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TmsInspection extends Model
{
    
    static $rules = [
		'batch_id' => 'required',
		'class_no' => 'required',
		'lab_size' => 'required',
		'electricity' => 'required',
		'internet' => 'required',
		'lab_bill' => 'required',
		'lab_attendance' => 'required',
		'computer' => 'required',
		'router' => 'required',
		'projector' => 'required',
		'student_laptop' => 'required',
		'lab_security' => 'required',
		'lab_register' => 'required',
		'class_regularity' => 'required',
		'trainer_attituted' => 'required',
		'trainer_tab_attendance' => 'required',
		'upazila_audit' => 'required',
		'upazila_monitoring' => 'required',
		'remark' => 'required',
		'Updated_at' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batch_id','class_no','lab_size','electricity','internet','lab_bill','lab_attendance','computer','router','projector','student_laptop','lab_security','lab_register','class_regularity','trainer_attituted','trainer_tab_attendance','upazila_audit','upazila_monitoring','remark','asset_list','created_by','updated_by','Updated_at'];



}
