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
        'level_id',
        'correct_option',
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

    public function level(){
        return $this->hasOne(SubjectLevel::class, 'level_id', 'id');
    }
}
