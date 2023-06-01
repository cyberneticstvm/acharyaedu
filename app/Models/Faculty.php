<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'subject_id',
        'created_by',
        'updated_by'
    ];

    public function subject(){
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}
