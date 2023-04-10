<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'batch_id',
        'cut_off_mark',
        'question_count',
        'exam_date',
        'duration',
        'created_by',
        'updated_by',
    ];

    public function batch(){
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }

    public function questions(){
        return $this->hasMany(ExamQuestion::class, 'exam_id', 'id');
    }

    protected $casts = ['exam_date' => 'datetime'];
}
