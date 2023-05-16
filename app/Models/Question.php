<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'subject_id',
        'topic_id',
        'chapter_id',
        'correct_option',
        'explanation',
        'exam_type',
        'available_for_free',
        'status',
        'created_by',
        'updated_by',
    ];

    public function options(){
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    public function courses(){
        return $this->hasMany(QuestionCourse::class, 'question_id', 'id');
    }

    public function subject(){
        return $this->hasOne(Subject::class, 'subject_id', 'id');
    }

    public function topic(){
        return $this->hasOne(Topic::class, 'topic_id', 'id');
    }

    public function levels(){
        return $this->hasMany(QuestionLevel::class, 'question_id', 'id');
    }
}
