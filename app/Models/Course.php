<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function questions(){
        return $this->hasMany(Question::class, 'id', 'question_id');
    }

    public function batches(){
        return $this->hasMany(Batch::class);
    }
}
