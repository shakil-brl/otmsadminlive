<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBatch extends Model
{
    use HasFactory;
    protected $table = "training_batches";
    protected $guarded = [];

    public function Provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function training()
    {
        return $this->hasMany(Training::class, 'id', 'trainingId');
    }
}