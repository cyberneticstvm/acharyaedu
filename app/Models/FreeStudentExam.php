<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeStudentExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'student_id',
        'correct_answer_count',
        'wrong_answer_count',
        'unattended_count',
        'total_mark',
        'cutoff_mark',
        'total_mark_after_cutoff',
        'grade',
    ];

    public function exam(){
        return $this->hasOne(FreeExam::class, 'id', 'exam_id');
    }

    public function scores(){
        return $this->hasMany(FreeExamScore::class, 'student_exam_id', 'id');
    }
}
