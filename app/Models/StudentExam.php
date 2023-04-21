<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
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
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }

    public function scores(){
        return $this->hasMany(StudentExamScore::class, 'student_exam_id', 'id');
    }
}
