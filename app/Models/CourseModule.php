<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'module',
        'created_by',
        'updated_by',
    ];

    public function modules(){
        return $this->belongsTo(Topic::class, 'module', 'id');
    }
}
