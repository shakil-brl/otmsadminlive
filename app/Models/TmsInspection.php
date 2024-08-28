<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmsInspection
 *
 * @property $id
 * @property $batche_id
 * @property $user_id
 * @property $classnum
 * @property $labsize
 * @property $electricity
 * @property $internet
 * @property $labbill
 * @property $labattandance
 * @property $computer
 * @property $router
 * @property $projectortv
 * @property $usinglaptop
 * @property $labsecurity
 * @property $labreagister
 * @property $classreagulrity
 * @property $teacattituted
 * @property $teaclabatten
 * @property $upojelaodit
 * @property $upozelamonotring
 * @property $remark
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
		'visit_date' => 'required|date|before_or_equal:today',
		'class_no' => 'required|integer|lte:132',
	];

	protected $perPage = 20;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['batche_id', 'user_id', 'classnum', 'labsize', 'electricity', 'internet', 'labbill', 'labattandance', 'computer', 'router', 'projectortv', 'usinglaptop', 'labsecurity', 'labreagister', 'classreagulrity', 'teacattituted', 'teaclabatten', 'upojelaodit', 'upozelamonotring', 'remark', 'Updated_at'];



}
