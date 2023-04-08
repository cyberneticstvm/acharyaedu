<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'level_id',
    ];

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function level(){
        return $this->belongsTo(SubjectLevel::class, 'level_id', 'id');
    }
}
