<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'title',
        'video_id',
        'description',
        'category',
        'type',
        'created_by',
        'updated_by',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
