<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'revision_id',
        'batch_id',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class, 'id', 'batch_id');
    }
}
