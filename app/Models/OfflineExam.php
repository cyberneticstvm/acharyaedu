<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineExam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['exam_date' => 'date'];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
}
