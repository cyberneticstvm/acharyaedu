<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_type',
        'name',
        'course',
        'start_date',
        'fee',
        'status',
        'created_by',
        'updated_by',
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course');
    }

    public function courses(){
        return $this->hasMany(BatchCourse::class, 'batch_id', 'id');
    }

    public function batchsyllabi(){
        return $this->hasMany(BatchSyllabs::class, 'batch');
    }

    public function studentbatches(){
        return $this->hasMany(StudentBatch::class, 'batch');
    }

    public function exams(){
        return $this->hasMany(Exam::class, 'batch_id', 'id')->orderByDesc('exam_date');
    }
}
