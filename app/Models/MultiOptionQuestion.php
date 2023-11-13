<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiOptionQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function batches()
    {
        return $this->hasMany(MultiOptionQuestionBatch::class, 'question_id', 'id');
    }
}
