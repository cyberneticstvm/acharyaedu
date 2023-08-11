<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'course_id',
    ];
}
