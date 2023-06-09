<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'title',
        'batch_id',
        'subject_id',
        'attachment',
        'notes',
        'description',
        'created_by',
        'updated_by',
    ];

    public function doctype(){
        return $this->belongsTo(DocumentType::class, 'document_type', 'id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function modules(){
        return $this->hasMany(DownloadModule::class);
    }
}
