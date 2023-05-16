<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
        'level_id',
        'created_by',
        'updated_by',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function level(){
        return $this->belongsTo(SubjectLevel::class, 'level_id', 'id');
    }
}
