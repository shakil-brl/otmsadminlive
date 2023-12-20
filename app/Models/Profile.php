<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 *
 * @property $id
 * @property $Gender
 * @property $DateOfBirth
 * @property $KnownAs
 * @property $Created
 * @property $BloodGroup
 * @property $Email
 * @property $NID
 * @property $Phone
 * @property $Religion
 * @property $BirthRegNo
 * @property $FatherName
 * @property $MotherName
 * @property $PassportNo
 * @property $FatherNameBangla
 * @property $KnownAsBangla
 * @property $MotherNameBangla
 * @property $MaritalStatus
 * @property $division_code
 * @property $district_code
 * @property $upazila_id
 * @property $address
 * @property $postname
 * @property $division_code_present
 * @property $district_code_present
 * @property $upazila_id_present
 * @property $address_present
 * @property $postname_present
 * @property $PhotoUrl
 * @property $Phone2
 * @property $SignatureUrl
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Profile extends Model
{
    
    static $rules = [
		'DateOfBirth' => 'required',
		'Created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Gender','DateOfBirth','KnownAs','Created','BloodGroup','Email','NID','Phone','Religion','BirthRegNo','FatherName','MotherName','PassportNo','FatherNameBangla','KnownAsBangla','MotherNameBangla','MaritalStatus','division_code','district_code','upazila_id','address','postname','division_code_present','district_code_present','upazila_id_present','address_present','postname_present','PhotoUrl','Phone2','SignatureUrl'];



}
