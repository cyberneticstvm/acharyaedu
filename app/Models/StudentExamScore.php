<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_exam_id',
        'question_id',
        'subject_id',
        'correct_option',
        'selected_option',
        'answer',
    ];

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
