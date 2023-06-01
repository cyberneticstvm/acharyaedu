<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'exam_type',
    ];

    public function topics(){
        return $this->hasMany(Topic::class, 'subject_id', 'id');
    }

    public function etype(){
        return $this->hasOne(ExamType::class, 'id', 'exam_type');
    }
}
