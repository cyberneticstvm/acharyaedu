<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'batch',
        'date_joined',
        'status',
        'cancelled',
        'created_by',
        'updated_by',
    ];

    public function studentname()
    {
        return $this->belongsTo(Student::class, 'student', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch');
    }

    public function batchh()
    {
        return $this->belongsTo(Batch::class, 'batch');
    }
}
