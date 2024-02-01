<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function batch()
    {
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }
}
