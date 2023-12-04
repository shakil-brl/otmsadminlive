<?php

namespace App\Models;

use App\Models\TrainingBatch;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inspectionconfig
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
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inspectionconfig extends Model
{

    static $rules = [
        'batche_id' => 'required',
        'classnum' => 'required',
        'labsize' => 'required',
        'electricity' => 'required',
        'internet' => 'required',
        'labbill' => 'required',
        'labattandance' => 'required',
        'computer' => 'required',
        'router' => 'required',
        'projectortv' => 'required',
        'usinglaptop' => 'required',
        'labsecurity' => 'required',
        'labreagister' => 'required',
        'classreagulrity' => 'required',
        'teacattituted' => 'required',
        'teaclabatten' => 'required',
        'upojelaodit' => 'required',
        'upozelamonotring' => 'required',
        'remark' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batche_id', 'user_id', 'classnum', 'labsize', 'electricity', 'internet', 'labbill', 'labattandance', 'computer', 'router', 'projectortv', 'usinglaptop', 'labsecurity', 'labreagister', 'classreagulrity', 'teacattituted', 'teaclabatten', 'upojelaodit', 'upozelamonotring', 'remark'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = 1;
        });
    }


    public function batch()
    {
        return $this->belongsTo(TrainingBatch::class, 'batche_id', 'id');
    }

}