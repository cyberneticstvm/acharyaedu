<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'batch',
        'reason',
    ];

    protected $casts = ['date' => 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student');
    }

    public function studentName()
    {
        return $this->belongsTo(Student::class, 'student');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch', 'id');
    }

    public function batchName()
    {
        return $this->belongsTo(Batch::class, 'batch');
    }
}
