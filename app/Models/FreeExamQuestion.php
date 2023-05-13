<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question_id',
        'created_by',
        'updated_by',
    ];

    public function exam(){
        return $this->hasOne(FreeExam::class, 'id', 'exam_id');
    }

    public function question(){
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
}
