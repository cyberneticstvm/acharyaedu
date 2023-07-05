<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'name',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function questions(){
        return $this->HasMany(Question::class, 'topic_id', 'id');
    }
}
