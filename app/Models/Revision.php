<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'batch_id',
        'date',
        'status',
        'created_by',
        'updated_by',
    ];

    public function modules(){
        return $this->hasMany(RevisionModule::class, 'revision_id', 'id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    protected $casts = ['date' => 'date'];
}
