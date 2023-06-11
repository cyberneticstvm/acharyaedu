<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'faculty_id',
        'subject_id',
        'class_date',
        'class_time',
        'notes',
        'type',
        'link',
        'created_by',
        'updated_by',
    ];

    public function subject(){
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function faculty(){
        return $this->hasOne(Faculty::class, 'id', 'faculty_id');
    }

    public function batch(){
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }

    protected $casts = ['class_date' => 'date'];
}
